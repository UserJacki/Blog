<?php

//RUTAS MODERADOR
Route::middleware(['auth','verified','role:moderador'])->group(function(){

    //el route:resource engloba todas las rutas del moderador y para modificar el nombre de cada ruta se hace de la siguiente manera
    Route::resource('moderador/articulos','moderador\ArticleController',['names' =>[
        'index' => 'moderador.articulos.index',
        'create' => 'moderador.articulos.create',
        'store' => 'moderador.articulos.store',
        'show' => 'moderador.articulos.show',
        'edit' => 'moderador.articulos.edit',
        'update' => 'moderador.articulos.update',
        'destroy' => 'moderador.articulos.destroy',
    ]]);
    Route::get('moderador/imagenes/{imagen}','moderador\ArticleImageController@destroy')->name('moderador.imagen.delete');
    Route::get('moderador/buscador/articulos','moderador\SearchArticleController@index');
});
