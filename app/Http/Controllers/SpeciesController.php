<?php

namespace App\Http\Controllers;

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
        $data = $species->pokemons()->get();
        return response()->json($data);
    }
}
