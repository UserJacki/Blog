<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Theme;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$temasall=Theme::all();//ver todos los temas
        //return view('home')->with(compact('temasall')); //add
        return view('home');
    }
}
