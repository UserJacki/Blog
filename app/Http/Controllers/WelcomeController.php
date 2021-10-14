<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theme;

class WelcomeController extends Controller
{
    //
    public function welcome(){

        //$temas=DB::table('theme')->get();
        //$temasall=Theme::all();
        //return dd($temast);
        $temasDestacados=Theme::where('destacado', 1)->with(['articles.images'])->orderBy('id', 'desc')->get();
        return view('welcome')->with(compact('temasDestacados'));
    }
}
