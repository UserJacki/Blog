<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable Implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'usuario', 'web', 'password', //se agregó usuario y web
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relacion 1:n de $user->theme
    public function themes(){
        return $this->hasMany(Theme::class);
    }
    //relacion 1:n de $user->article
    public function articles(){
        return $this->hasMany(Article::class);
    }

    //relacion n:n de $user->role
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    //se crea el ACCESOR para retornar el primer valor en mayuscula pero solo se refleja en la vista y bno se guarda
    /* public function getNameAttribute($valor){
            return ucfirst(strtolower($valor));
    }*/

    //se crea el MUTTOR para retornar el primer valor en mayuscula y guarda el cambio en la bd
    public function setNameAttribute($valor){
        //$this->attributes['name']=ucfirst(strtolower($valor)); con esto da error al crear nombre con tilde y abajo ya se corrigio
        $this->attributes['name']=ucfirst(mb_strtolower($valor, 'UTF-8'));
    }

    public function hasRole($role){
        $roles=$this->roles()->get();
        foreach ($roles as $suRole) {
            if ($suRole->nombre==$role) //NO SE PUEDEN LLAMAR LAS DOS VARIABLES IGUALES averiguar poraue le if no lleva llaves
                return true;

        }
        return false;
    }

    //SE CREAN LOS ACCESORS PARA EL CONTROLADORuSER
    public function getUsuarioRolesAttribute()
    {
        $roles=$this->roles;
            foreach ($roles as $role)
            {
                    echo $role->nombre."<br>";
            }
    }

    public function getUsuarioBloqueadoAttribute()
    {
        $bloqueado=$this->bloqueado;
        if(!$bloqueado)
            return "No Bloqueado";
        return "Bloqueado";
    }

}
