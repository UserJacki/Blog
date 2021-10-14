<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\softDeletes;


class Article extends Model
{
    use softDeletes;

    protected $dates=['deleted_at'];
    protected $fillable=['titulo','contenido','activo','theme_id']; //se agrega lo del relleno masivo de datos con esta liena

    //SE RELACIONA CON LA TABLA TEMAS Y LA TABLA USUARIOS(LLAVES FORANEAS)
    //Relacion 1:1 $article->theme
    public function theme(){
        return $this->belongsTo(Theme::class);
    }
    //Relacion 1:1 $article->user
    public function user(){
        return $this->belongsTo(User::class);
    }
    //Relacion 1:n $article->articleimage
    public function images(){
        return $this->hasMany(Articleimage::class);
    }

    //crear un metodo en caso de que el articulo no tenga imagenes y no nos marque un error
    public function imagenDestacada(){
        $imagenDestacada= $this->images->first();
        if (!$imagenDestacada) {
            # code...
            return 'sin_imagen.jpg';
        return $imagenDestacada->nombre;
        }
    }

    //SE CREA UNA QUERY SCOPE LOCAL PARA HACER EL CODIGO MAS FUNCIONAL
    public function scopeArticuloActivo($consulta)
    {
        return $consulta->where('activo', '=', 1);
    }

    //SE CREA UNA QUERY SCOPE LOCAL PARA HACER EL CODIGO MAS FUNCIONAL

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('activo', function ($query) {
            return $query->where('activo', true);
        });
    }

    //se crea otra funcion
    public function getEstaActivadoAttribute(){
        $estaActivado=$this->activo;
        if ($estaActivado)
            return "Si";
        return "No";
    }

}
