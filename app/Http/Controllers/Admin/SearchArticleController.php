<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Theme;
use App\User;

class SearchArticleController extends Controller
{
    public function index(Request $request)
    {
        $miga = 'Buscador de Articulos';
        $busqueda = $request->busqueda;
        $tema=Theme::where('nombre','like',"$busqueda")->first(); //para que la busqueda sea exacta se le añade lo de $busqueda
        $usuario=User::where('name','like',"$busqueda")->first(); //es decir que tengo que poner la palabra tal cual para que me aparezca
        if ($usuario) {
            foreach ($usuario->roles as $role) {
                if ($role->nombre=="administrador" || $role->nombre=="moderador") {
                    $articulos=$usuario->articles()->withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->get();
                    return view('admin.articulos.buscador')->with(compact('miga','articulos'));
                }
            }
        }

        if ($tema) {
            $articulos=$tema->articles()->withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->get();
            return view('admin.articulos.buscador')->with(compact('miga','articulos'));
        }

        $articulos=Article::withoutGlobalScope('activo')->with(['user','theme'])->where('titulo','like',"%$busqueda%")->orderBy('id','desc')->get();
        return view('admin.articulos.buscador')->with(compact('miga','articulos'));
    }
}
