<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Theme;
use Illuminate\Support\Facades\Storage;

class BorrarTema implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    //se crea un atributo a la clase que va a contener el objeto tema
    //el protected quiere decir que va a ser protegido y solo usado por esta clase y sus desendientes
    protected $tema;

    public function __construct(Theme $tema)
    {
        //se pasa el objeto tema por el contructor y no directamente en el metodo handle
        $this->tema=$tema;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //aqui es donde se pasa el metodo creado en el controlador tema para borrar el tema
        $tema=$this->tema;
        $articulos=$tema->articles()->with(['images'])->get();
        foreach ($articulos as $articulo) {
            //para borrar definitivamente las imagenes y no queden residios en la carpeta se ejecuta el siguiente foreach dentro del foreach ya creado
            foreach ($articulo->images as $imagen) {
                # se borra fisicamente en la carpeta
                Storage::disk('public')->delete('/imageArticle/' .$imagen->nombre);
            }
            $articulo->images()->delete();
            $articulo->delete();
        }
        $tema->delete();
    }
}
