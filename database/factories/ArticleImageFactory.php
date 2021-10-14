<?php

use Faker\Generator as Faker;

$factory->define(App\ArticleImage::class, function (Faker $faker) {
    return [
        //Quiero guaradar las imagenes en storage/app/public/y ahoi crearemos la carpeta de imagenes
        'nombre' =>\Faker\Provider\Image::image(storage_path(). '/app/public/imageArticle', 250, 250, 'cats', false),
        'article_id' => $faker->numberBetween(1,50),  //el 1 y 25 hace referencia a cuantos articulos tengo en la tabla
    ];
});
