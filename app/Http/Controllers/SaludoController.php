<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaludoController extends Controller
{
    //crear metodos
    public function saludo(){
        return view('saludo');
    }
}
