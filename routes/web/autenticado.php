<?php

//RUTA USUARIOS AUTENTICADOS
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified'); //RUTA ORIGEN de redireccion despues de loguearse
Route::put('/actualizar', 'UserController@update')->name('actualizaruser'); //ruta del buscador //actualizar datos de usuario
