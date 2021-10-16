<?php

//RUTAS PARA USUARIOS NORMALES ES DECIR, INVITADOS
Route::get('/', 'WelcomeController@welcome')->name('welcome'); //index
Route::get('/tema/{tema}','ThemeController@show')->name('tema'); //articulos por cada tema
Route::get('/buscador', 'SearchController@index')->name('buscador'); //ruta del buscador
