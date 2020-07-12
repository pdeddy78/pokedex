<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Pokemon;
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

        $data = Pokemon::where('id', $id)->get();
        return response()->json($data);
    }

    public function test()
    {
        $locale = App::getLocale();
        die(var_dump($locale));
    }
}
