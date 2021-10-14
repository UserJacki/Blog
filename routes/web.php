<?php


/*Route::get('/', function () {
    return view('welcome');
});*/

//RUTAS PARA USUARIOS NORMALES ES DECIR, INVITADOS
Route::get('/', 'WelcomeController@welcome')->name('welcome'); //index
Route::get('/tema/{tema}','ThemeController@show')->name('tema'); //articulos por cada tema
Route::get('/buscador', 'SearchController@index')->name('buscador'); //ruta del buscador


//RUTA USUARIOS AUTENTICADOS
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified'); //RUTA ORIGEN de redireccion despues de loguearse
Route::put('/actualizar', 'UserController@update')->name('actualizaruser'); //ruta del buscador //actualizar datos de usuario

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

