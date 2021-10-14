<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class ArticleImage extends Model
{
    use softDeletes;

    protected $dates=['deleted_at'];

    //Relacion 1:1 $articleimage->article
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
