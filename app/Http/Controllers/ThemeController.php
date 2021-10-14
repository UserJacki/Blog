<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theme;

class ThemeController extends Controller
{
    //Crear vistas para mostrar los articulos por tema
    public function show(Theme $tema){
        $temasall=Theme::all();  //esto se lo quita en el video pero si lo quito me dará error
        //$tema=Theme::find($theme_id);
        //$tema=Theme::where('slug', '=', $slug)->first();
        //$articulos=$tema->articles()->where('activo', '=', 1)->orderBy('id', 'desc')->get();
        //$articulos=$tema->articles()->where('activo', '=', 1)->with('images')->orderBy('id', 'desc')->paginate(2);//alicar lo del paginador quitando el get y poniendo paginate
        //return view('tema.articulos')->with(compact('temasall', 'tema', 'articulos'));  //igual aqui se supone que debo quitar el temasall

        //se crea la funcion para mostrar los articulos por autenticacion y se agrega la logica de usuario bloqueda ono
        $userAutenticado = True;
        $userBloqueado = False;
        $userVerificado = True;

        if ($tema->suscripcion) {
            if (auth()->check())
            {
                if (!is_null(auth()->user()->email_verified_at)) {
                    if (auth()->user()->bloqueado) {
                        $userBloqueado = true;
                        return view('tema.articulos')->with(compact('temasall', 'tema','userAutenticado', 'userBloqueado', 'userVerificado'));
                    }
                $userVerificado = false;
                return view('tema.articulos')->with(compact('temasall', 'tema','userAutenticado', 'userBloqueado', 'userVerificado'));
                }

                $articulos=$tema->articles()->with(['images'])->orderBy('id', 'desc')->paginate(2);
                return view('tema.articulos')->with(compact('temasall', 'tema', 'articulos', 'userAutenticado', 'userBloqueado', 'userVerificado'));
            }
            $userAutenticado = False;
            return view('tema.articulos')->with(compact('temasall', 'tema', 'userAutenticado', 'userBloqueado', 'userVerificado'));
        }
        $articulos=$tema->articles()->ArticuloActivo()->with(['images'])->orderBy('id', 'desc')->paginate(2);
        return view('tema.articulos')->with(compact('temasall', 'tema', 'articulos', 'userAutenticado', 'userBloqueado', 'userVerificado'));
    }
}
