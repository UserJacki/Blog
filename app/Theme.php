<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Theme extends Model
{
    //se agrega lo del trauductor de fechas
    //use TraductorFechas;
    use softDeletes;

    protected $dates=['deleted_at'];
    //relleno amsivo del controlador theme
    protected $fillable=['nombre', 'destacado', 'suscripcion'];

    //para traer el slug en la url en vez del id
    public function getRouteKeyName(){
        return 'slug';
    }

    // Rlacionar este modelo con el modelo user 1:1  $theme->user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relacionar modelo con el modelo article 1:n  $theme->article
    public function articles(){
        return $this->hasMany(Article::class);
    }

    //SE CREAN LOS ACCESSOR PARA QUE EN VEZ DE UNO Y CERO EN SUB Y DESTACADONOS MUESTRE ALGO MAS LEGIBLE AL USER
    public function getEsDestacadoAttribute(){
        $ssDestacado=$this->destacado;
        if ($ssDestacado)
            return 'Si';
        return 'No';
    }

    public function getEsSuscripcionAttribute(){
        $esSuscripcion=$this->suscripcion;
        if ($esSuscripcion)
            return 'Si';
        return 'No';
    }

}
