<?php

namespace App\Http\Controllers;

use App\Model\Species;

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
        $data = Species::all();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Species::where('id', $id)->get();
        return response()->json($data);
    }

    public function pokemons($id)
    {
        $data = Species::find($id)->pokemons;
        return response()->json($data);
    }
}
