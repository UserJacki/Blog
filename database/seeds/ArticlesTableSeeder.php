<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\ArticleImage;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $articles= factory(Article::class,50)->create();  //aqui crea 50 articulos a la base de datos
        $articles->each(function($article){
            $images=factory(ArticleImage::class,3)->make();
            $article->images()->saveMany($images);
        });

    }
}
