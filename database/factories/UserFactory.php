<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    /*return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ]; */
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        //add por Jack
        'usuario'=> $faker->unique()->name,
        'bloqueado' => $faker->boolean(false), //se agrega en la tabla
        'es_admin' => $faker->boolean(false), //se agrega en la tabla
        'web' => $faker->safeEmailDomain,
        //add por Jack
        //'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'password' =>bcrypt('12345'),
        'remember_token' => Str::random(10),
        'created_at' =>$faker->dateTimeBetween('-1 years', 'now'),  //add por jack
    ];
});
