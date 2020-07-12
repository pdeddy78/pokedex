<?php

namespace App\Http\Controllers;

use App\Model\Pokemon;

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

    public function index()
    {
        $data = Pokemon::where('is_default', 1)->get();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Pokemon::where('id', $id)->get();
        return response()->json($data);
    }
}
