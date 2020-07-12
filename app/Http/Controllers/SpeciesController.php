<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Species;
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

    public function index()
    {
        $lang = Language::where('identifier', ($request->has('lang')) ? $request->input('lang') : 'en');
        $langId = ($lang->count() == 0) ? 9 : $lang->first()->id;

        $data = Species::all();
        return response()->json($data);
    }

    public function show($id)
    {
        $lang = Language::where('identifier', ($request->has('lang')) ? $request->input('lang') : 'en');
        $langId = ($lang->count() == 0) ? 9 : $lang->first()->id;

        $data = Species::where('id', $id)->get();
        return response()->json($data);
    }

    public function pokemons($id)
    {
        $lang = Language::where('identifier', ($request->has('lang')) ? $request->input('lang') : 'en');
        $langId = ($lang->count() == 0) ? 9 : $lang->first()->id;

        $data = Species::find($id)->pokemons;
        return response()->json($data);
    }
}
