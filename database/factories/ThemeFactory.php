<?php

use Faker\Generator as Faker;

$factory->define(App\Theme::class, function (Faker $faker) {
    //para hacer coincidir el nombre y el slug se crea la siguiente variable
    $nombre=$faker->unique()->word;
    return [
        'user_id' => $faker->numberBetween(1,6), //esta es la llave foranea, tener cuidado de no pasar de los usuarios registrados
        //'nombre' => ucfirst($faker->unique()->word),  //el ucfirst es para poner el la primera letra en mayuscula
        //'slug' => $faker->unique()->word,
        'nombre' => ucfirst($nombre),
        'slug' => $nombre,
        'destacado' => $faker->boolean(false),
        'suscripcion' => $faker->boolean(false),
    ];
});
