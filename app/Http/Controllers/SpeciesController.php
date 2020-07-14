<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Language;
use App\Models\Species;
use App\Models\SpeciesName;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $lang = Language::where('identifier', ($request->has('lang')) ? $request->input('lang') : 'en');
        $langId = ($lang->count() == 0) ? 9 : $lang->first()->id;

        $data = Species::all();
        return response()->json($data);
    }

    public function show(Request $request, $id)
    {
        $lang = Language::where('identifier', ($request->has('lang')) ? $request->input('lang') : 'en');
        $langId = ($lang->count() == 0) ? 9 : $lang->first()->id;

        $data = Species::find($id);
        return response()->json($data);
    }

    public function pokemons(Request $request, $id)
    {
        $lang = Language::where('identifier', ($request->has('lang')) ? $request->input('lang') : 'en');
        $langId = ($lang->count() == 0) ? 9 : $lang->first()->id;

        $species = Species::find($id);
        $name = $species->name()->where('local_language_id', $langId)->first();
        $data = [];
        foreach ($species->pokemons()->get() as $row) {
            $pokemon_species_form_id = Form::where('pokemon_id', $row->id)->first();
            $pokemon_species_form_name = ($pokemon_species_form_id == null) ? null : Form::find($pokemon_species_form_id->id)->localFormName($langId)->first();

            $data[] = [
                'id' => $row->id,
                'identifier' => $row->identifier,
                'form_type' => ($pokemon_species_form_name == null) ? null : $pokemon_species_form_name->form_name,
                'form_name' => ($pokemon_species_form_name == null) ? null : $pokemon_species_form_name->pokemon_name,
                'name' => ($name == null) ? null : $name->name,
                'genus' => ($name == null) ? null : $name->genus,
                'height' => $row->height / 10, # meter
                'weight' => $row->weight / 10, # kilogram
                'base_experience' => intval($row->base_experience),
                'order' => intval($row->order)
            ];
        }
        return response()->json($data);
    }
}
