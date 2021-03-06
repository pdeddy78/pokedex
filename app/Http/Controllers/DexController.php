<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Generation;
use App\Models\Language;
use App\Models\Pokemon;
use App\Models\Species;
use Illuminate\Http\Request;

class DexController extends Controller
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

        $data = Pokemon::where('is_default', 1)->get();
        return response()->json($data);
    }

    public function show(Request $request, $id)
    {
        $lang = Language::where('identifier', ($request->has('lang')) ? $request->input('lang') : 'en');
        $langId = ($lang->count() == 0) ? 9 : $lang->first()->id;

        $pokemon = Pokemon::find($id);
        $pokemon_name = $pokemon->localPokemonName($langId)->first();

        $pokemon_form_id = Form::where('pokemon_id', $id)->first();
        $pokemon_form_name = Form::find($pokemon_form_id->id)->localFormName($langId)->first();

        $species = Species::find($id);
        $sp_generation = $species->generation()->first();
        $region_id = $sp_generation->main_region_id;
        $generation = Generation::find($sp_generation->id)->localGenerationName($langId)->first();
        $pokemon_species = $species->pokemons()->get();
        $pokemon_forms = [];
        if ($pokemon_species->count() > 1) {
            foreach ($pokemon_species as $row) {
                $pokemon_species_form_id = Form::where('pokemon_id', $row->id)->first();
                $pokemon_species_form_name = Form::find($pokemon_species_form_id->id)->localFormName($langId)->first();

                $pokemon_forms[] = [
                    'id' => $row->id,
                    'identifier' => $row->identifier,
                    'form_type' => ($pokemon_species_form_name == null) ? null : $pokemon_species_form_name->form_name,
                    'form_name' => ($pokemon_species_form_name == null) ? null : $pokemon_species_form_name->pokemon_name,
                    'height' => $row->height / 10, # meter
                    'weight' => $row->weight / 10, # kilogram
                    'base_experience' => intval($row->base_experience),
                    'order' => intval($row->order)
                ];
            }
        }

        $data = [
            'id' => $pokemon->id,
            'identifier' => $pokemon->identifier,
            'form_type' => ($pokemon_form_name == null) ? null : $pokemon_form_name->form_name,
            'name' => $pokemon_name->name,
            'genus' => $pokemon_name->genus,
            'height' => $pokemon->height / 10, # meter
            'weight' => $pokemon->weight / 10, # kilogram
            'base_experience' => intval($pokemon->base_experience),
            'generation' => $generation->name,
            'order' => intval($pokemon->order),
            'forms' => $pokemon_forms
        ];

        return response()->json($data);
    }

    public function test()
    {
        die('diediediediediediediediediediedie');
    }
}
