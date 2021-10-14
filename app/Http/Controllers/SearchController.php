<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class SearchController extends Controller
{
    //se crea el metodo index para la busqueda
    public function index(Request $request){
        //$busqueda=$request->busqueda;
        /* $articulos=Article::where('titulo', 'like', "%$busqueda%")->ArticuloActivo()->with(['images'])->orderBy('id', 'desc')->get();
        return view('buscador')->with(compact('articulos')); */
        //se crea una mejor manera para no pasar losfiltros de segurodad en las busquedas
        $articulosPermitidos=collect();
        $busqueda=$request->busqueda;

        if (auth()->check())
        {

            if (!is_null(auth()->user()->email_verified_at)) {
                if (auth()->user()->bloqueado) {
                    $articulos=Article::where('titulo', 'like', "%$busqueda%")->with(['images'])->orderBy('id', 'desc')->get();
                    return view('buscador')->with(compact('articulos'));
                }

                $articulos=Article::where('titulo', 'like', "%$busqueda%")->with(['images'])->orderBy('id', 'desc')->get();
                foreach ($articulos as $articulo) {
                    if (!$articulo->theme->suscripcion)
                        $articulosPermitidos->push($articulo);
                }
                return view('buscador')->with(compact('articulosPermitidos'));
            }
            $articulos=Article::where('titulo', 'like', "%$busqueda%")->with(['images'])->orderBy('id', 'desc')->get();
                foreach ($articulos as $articulo) {
                    if (!$articulo->theme->suscripcion)
                        $articulosPermitidos->push($articulo);
                }
                return view('buscador')->with(compact('articulosPermitidos'));



        }

        $articulos=Article::where('titulo', 'like', "%$busqueda%")->with(['images'])->orderBy('id', 'desc')->get();
        foreach ($articulos as $articulo) {
            if (!$articulo->theme->suscripcion)
                $articulosPermitidos->push($articulo);
        }
        return view('buscador')->with(compact('articulosPermitidos'));
    }
}
