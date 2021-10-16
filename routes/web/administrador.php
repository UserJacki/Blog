<?php

//SE AGREGAN LAS RUTAS DENTRO DEL MIDLEWARE
Route::middleware(['auth','role:administrador'])->group(function(){
    //RUTAS ADMINISTRADOR
    Route::get('/admin/temas', 'admin\ThemeController@index')->name('admintema'); //ruta del buscador
    Route::delete('/admin/temas/{tema}','admin\ThemeController@destroy')->name('tema.delete'); //eliminar el tema con todo y sus articulos
    Route::get('admin/temas/{tema}/edit','admin\ThemeController@edit')->name('tema.edit');
    Route::put('admin/temas/{tema}','admin\ThemeController@update')->name('tema.update');
    Route::get('admin/temas/create','admin\ThemeController@create')->name('tema.create');
    Route::post('admin/temas','admin\ThemeController@store')->name('tema.store');

    //TODAS LAS RUTAS DEL CRUD DE ARTICULOS SE RESUME EN ESTO:
    Route::resource('admin/articulos','admin\ArticleController');
    Route::get('admin/imagenes/{imagen}','admin\ArticleImageController@destroy')->name('imagen.delete');
    Route::get('admin/buscador/articulos','admin\SearchArticleController@index');

    Route::get('admin/articulos-borrados','admin\ArticleDeleteController@index')->name('articulos-borrados.index');
    Route::put('admin/articulos-borrados/{articulo_id}','admin\ArticleDeleteController@restaurar')->name('articulos-borrados.restaurar');
    Route::delete('admin/articulos-borrados/{articulo_id}','admin\ArticleDeleteController@destroy')->name('articulos-borrados.destroy');
    Route::get('admin/articulos-borrados/{articulo_id}','admin\ArticleDeleteController@show')->name('articulos-borrados.show');

    //RUTAS DEL CORREO MASIVO
    Route::get('admin/correo-masivo','admin\CorreoMasivoController@index');
    Route::post('admin/correo-masivo','admin\CorreoMasivoController@correoMasivo');

    //Ruta para el UserController dentro del Middleware
    Route::resource('admin/usuarios','admin\UserController')->only(['index','edit','update']);
    Route::get('admin/buscador/usuarios','admin\SearchUserController@index');

});
