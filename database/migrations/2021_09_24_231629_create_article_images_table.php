<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('article_id')->unsigned()->default(1);  //se creal el campo y va a ser sin signo y un valor por defecto que será 1
            $table->foreign('article_id')->references('id')->on('articles');  //se crea la llave foranea para hacer referencia al id de users
            $table->softDeletes();  //Realiza el borrado logico
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_images');
    }
}
