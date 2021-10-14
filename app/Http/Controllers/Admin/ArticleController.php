<?php

namespace App\Http\Controllers\admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/*---IMPORTAR LAS LIBRERIAS */
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\ArticleImage;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //se crea la vista
        $miga='Articulos';
        $todosArticulos=Article::withoutGlobalScope('activo')->count();
        $articulos=Article::withoutGlobalScope('activo')->with(['user','theme'])->orderBy('id','desc')->paginate(10);
        return view('admin.articulos.index')->with(compact('miga','articulos','todosArticulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $miga='Agregar Articulo';
        return view('admin.articulos.create')->with(compact('miga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=[
            'titulo.required' => 'El campo titulo no debe estar vacio',
            'titulo.unique' => 'El titulo del el articulo ya existe por favor prueba con otro',
            'contenido' => 'El contenido no debe quedar vacio, por favor escribe algo',
            'foto0.mimes' => 'No es una imagen',
            'foto0.max' => 'Archivo demasiado grande',
            'foto1.mimes' => 'No es una imagen',
            'foto1.max' => 'Archivo demasiado grande',
            'foto2.mimes' => 'No es una imagen',
            'foto2.max' => 'Archivo demasiado grande',
        ];
        $rules=[
            'titulo' => 'required|unique:articles',
            'contenido' => 'required',
            'foto0' => 'mimes:jpeg,png|max:1048',
            'foto1' => 'mimes:jpeg,png|max:1048',
            'foto2' => 'mimes:jpeg,png|max:1048',
        ];
        $this->validate($request, $rules, $messages);

        $articulo= new Article($request->only('titulo','contenido','activo','theme_id'));
        /*$articulo->activo=$request->activar;
        $articulo->titulo=$request->titulo;
        $articulo->theme_id=$request->id;
        $articulo->contenido=$request->contenido; */
        $articulo->user_id=auth()->user()->id;
        $articulo->save();
        //GUARDAR IMAGEN EN EL PROYECTO
        for ($i=0; $i < 3; $i++) {
            if ($request->file('foto' .$i)) {
                $path=$request->file('foto' .$i)->store('public/imageArticle');
                $nombreimagen = collect(explode('/', $path))->last();
                //aqui se agrega lo de REDIMENCIONAR LA IMAGEN Y TRDUCIR SU PESO
                $extensionImagen = collection(explode('.', $path))->last();
                $imagen = Image::make(Storage::get($path));
                $imagen->resize(250,250);
                Storage::put($path, $imagen->encode($extensionImagen, 75));
                $imagen = new ArticleImage();
                $imagen->article_id = $articulo->id;
                $imagen->save();
            }
        }

        $articuloTitulo = $articulo->titulo;
        $notificacion="El articulo $articuloTitulo se ha añadido correctamente";
        return back()->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $miga='Mostrar Articulo';
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        return view('admin.articulos.show')->with(compact('miga','articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $miga='Editar Articulo';
        return view('admin.articulos.edit')->with(compact('articulo','miga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        $messages=[
            'titulo.required' => 'El campo titulo no debe estar vacio',
            'titulo.unique' => 'El titulo del el articulo ya existe por favor prueba con otro',
            'contenido' => 'El contenido no debe quedar vacio, por favor escribe algo',
            'foto1.mimes' => 'No es una imagen',
            'foto1.max' => 'Archivo demasiado grande',
            'foto2.mimes' => 'No es una imagen',
            'foto2.max' => 'Archivo demasiado grande',
            'foto3.mimes' => 'No es una imagen',
            'foto3.max' => 'Archivo demasiado grande',
        ];
        $rules=[
            'titulo' => 'required',Rule::unique('articles')->ignore($articulo->id),
            'contenido' => 'required',
            'foto1' => 'mimes:jpeg,png|max:1048',
            'foto2' => 'mimes:jpeg,png|max:1048',
            'foto3' => 'mimes:jpeg,png|max:1048',
        ];
        $this->validate($request, $rules, $messages);

        /*$articulo->activo=$request->activar;
        $articulo->titulo=$request->titulo;
        $articulo->theme_id=$request->id;
        $articulo->contenido=$request->contenido;
        //$articulo->user_id=auth()->user()->id;
        $articulo->save(); */
        $articulo->update($request->only('titulo','contenido','activo','theme_id'));

        for ($i=1; $i < 4; $i++) {
            if ($request->hasFile('foto' .$i)) {
                $path=$request->file('foto' .$i)->store('public/imageArticle');
                $nombreimagen = collect(explode('/', $path))->last();
                $extensionImagen = collection(explode('.', $path))->last();
                $imagen = Image::make(Storage::get($path));
                $imagen->resize(250,250);
                Storage::put($path, $imagen->encode($extensionImagen, 75));
                $imagen = new ArticleImage();
                $imagen->article_id = $articulo->id;
                $imagen->save();
            }
        }
        $miga='Articulos';
        $notificacion="El articulo se ha modificado correctamente";
        return redirect('admin/articulos')->with(compact('notificacion', 'miga'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo=Article::withoutGlobalScope('activo')->findOrFail($id);
        foreach ($articulo->images as $imagen) {
            Storage::disk('public')->delete('/imageArticle/' .$imagen->nombre);
        }
        $articulo->forceDelete();
        $notificacion="El articulo se eliminó correctamente";
        return back()->with(compact('notificacion'));
    }
}
