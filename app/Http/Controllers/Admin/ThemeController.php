<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Theme;
use Illuminate\Support\Facades\Storage;
use App\Jobs\BorrarTema;
use Illuminate\Validation\Rule;

class ThemeController extends Controller
{
    //se crea el metodo
    public function index(){
        $miga='Temas';
        $temas=Theme::with(['user'])->orderBy('id', 'desc')->get();
        return view('admin.temas.index')->with(compact('temas', 'miga'));
    }

    //create
    public function create(){
        $miga='Crear Tema';
        return view('admin.temas.create')->with(compact( 'miga'));
    }

    //store
    public function store(Request $request){
        $message=[
            'nombre.required' => 'El campo nombre no debe estar vacio',
            'nombre.unique' => 'El nombre tema ya existe',
        ];
        $rules=[
            'nombre'=>'required|unique:themes'
        ];

        $this->validate($request, $rules, $message);

        //se crea un nuevo tipo metodo para que un tema si es de suscripcion no sea destacado
        $destacado=$request->destacado;
        $suscripcion=$request->suscripcion;

        if ($destacado && $suscripcion) {
            $notificacion2="El tema de susucripcion no puede estar en la pagina de inicio";
            return back()->with(compact('notificacion2'));
        }

        //se cometan los tres porque se van añadir de forma masiva atravez de la liena que sesta abajo
        $tema=new Theme($request->all());
        $tema->user_id=auth()->user()->id;
        //$tema->nombre=$request->nombre;
        $tema->slug=mb_strtolower((str_replace(" ","-",$request->nombre)),'UTF-8'); //SE CORRIGE LODE LA TILDE
        //$tema->destacado=$request->destacado;
        //$tema->suscripcion=$request->suscripcion;
        $tema->save(); //para actualizar se utilizará save en vez de update al actualizar pocos valores
        $temaNombre=$tema->nombre;
        $notificacion="El tema $temaNombre se ha añadido correctamente";
        return back()->with(compact('notificacion'));
    }

    //edit
    public function edit(Theme $tema){
        $miga='Editar Tema';
        return view('admin.temas.edit')->with(compact('tema', 'miga'));
    }

    //update, para recoger los datos de un formulario es necesario el REQUEST
    public function update(Request $request, Theme $tema){
        $message=[
            'nombre.required' => 'El campo nombre no debe estar vacio',
            'nombre.unique' => 'El nombre tema ya existe',
        ];
        $rules=[
            'nombre'=>'required', Rule::unique('themes')->ignore($tema->id)
        ];

        //se crea un nuevo tipo metodo para que un tema si es de suscripcion no sea destacado
        $destacado=$request->destacado;
        $suscripcion=$request->suscripcion;

        if ($destacado && $suscripcion) {
            $notificacion2="El tema de susucripcion no puede estar en la pagina de inicio";
            return back()->with(compact('notificacion2'));
        }


        $this->validate($request, $rules, $message);

        /*$tema->nombre=$request->nombre;
        $tema->destacado=$request->destacado;
        $tema->suscripcion=$request->suscripcion;
        $tema->save(); */ //para actualizar se utilizará save en vez de update al actualizar pocos valores
        $tema->update($request->all());
        $miga='Temas';
        $notificacion1="El tema se actualizó correctamente";
        return redirect('admin/temas')->with(compact('notificacion1','miga'));

    }

    public function destroy(Theme $tema){
        //$tema->delete();
        //para poder boorar un tema como tiene llaves foraneas, primero se elimina la imagen luego el articulo y al final el tema
        /* $articulos=$tema->articles()->with(['images'])->get();
        foreach ($articulos as $articulo) {
            //para borrar definitivamente las imagenes y no queden residios en la carpeta se ejecuta el siguiente foreach dentro del foreach ya creado
            foreach ($articulo->images as $imagen) {
                # se borra fisicamente en la carpeta
                Storage::disk('public')->delete('/imageArticle/' .$imagen->nombre);
            }
            $articulo->images()->delete();
            $articulo->delete();
        }
        $tema->delete(); */

        $tema->forceDelete();
        //BorrarTema::dispatch($tema);    //Se para el JOB es decir la tarea creada de la siguiente manera
        $notificacion="El tema se eliminó correctamente"; //se crea un mensaje de que el tema se borró correctamente
        return back()->with(compact('notificacion'));
    }
}
