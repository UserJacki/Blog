<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;  //se importa la clase view
use App\Theme;  //nos traemos al modelo Theme

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //es para que no marque error al hacer una migracion de la base de datos
        Schema::defaultStringLength(191);

        //crear un View composer para pasar variables a todas partes o algo asi jaja
        //se pasa esta variable a todas las vistas con esto (['*'])
        //si queremos pasarlo simplemente a la vista de login se hace asi (['auth.register'])
        //si queremos pasar ados vistas de login seria (['auth.register', 'auth.login'])
        View::composer(['layouts.app', 'admin.articulos.create', 'admin.articulos.edit'], function($view){
            $temasall=Theme::all();
            $view->with(compact('temasall'));
        });
    }
}
