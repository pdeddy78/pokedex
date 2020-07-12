<?php

namespace App\Http\Controllers;

use App\Models\Form;
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
        $pokemon_name = $pokemon->name()->where('local_language_id', $langId)->first();
        $pokemon_species = Species::find($id)->pokemons()->get();
        $pokemon_forms = [];
        if ($pokemon_species->count() > 1) {
            foreach ($pokemon_species as $row) {
                $pokemon_id = $row->id;
                $pokemon_form_id = Form::where('pokemon_id', $pokemon_id)->first();
                if ($pokemon_form_id != null) {
                    $pokemon_form_name = Form::find($pokemon_form_id->id)->name()->where('local_language_id', $langId)->first();
                } else {
                    $pokemon_form_name = null;
                }
                
                $pokemon_forms[] = [
                    'id' => $row->id,
                    'identifier' => $row->identifier,
                    'form_name' => ($pokemon_form_name == null) ? null : $pokemon_form_name->form_name,
                    'name' => ($pokemon_form_name == null) ? null : $pokemon_form_name->pokemon_name,
                    'height' => $row->height / 10, # meter
                    'weight' => $row->weight / 10, # kilogram
                    'base_experience' => intval($row->base_experience),
                    'order' => $row->order
                ];
            }
        }

        $data = [
            'id' => $pokemon->id,
            'identifier' => $pokemon->identifier,
            'name' => ($pokemon_name == null) ? null : $pokemon_name->name,
            'genus' => ($pokemon_name == null) ? null : $pokemon_name->genus,
            'height' => $pokemon->height / 10, # meter
            'weight' => $pokemon->weight / 10, # kilogram
            'base_experience' => intval($pokemon->base_experience),
            'order' => $pokemon->order,
            'forms' => $pokemon_forms
        ];

        return response()->json($data);
    }

    public function test()
    {
        $locale = App::getLocale();
        die(var_dump($locale));
    }
}
