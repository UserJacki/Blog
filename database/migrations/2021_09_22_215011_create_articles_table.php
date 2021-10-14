<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->text('contenido')->nullable();
            $table->boolean('activo')->default(true);
            $table->integer('theme_id')->unsigned()->default(1);  //se creal el campo y va a ser sin signo y un valor por defecto que será 1
            $table->foreign('theme_id')->references('id')->on('themes');  //se crea la llave foranea para hacer referencia al id de users
            $table->integer('user_id')->unsigned()->default(1);  //se creal el campo y va a ser sin signo y un valor por defecto que será 1
            $table->foreign('user_id')->references('id')->on('users');  //se crea la llave foranea para hacer referencia al id de users
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
        Schema::dropIfExists('articles');
    }
}
