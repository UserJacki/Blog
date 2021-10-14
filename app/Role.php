<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //relacion muchos a muchos con el usuario
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
