<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //return route('login'); // cuando expira la sesion te redirige al login, en este caso usaremos el index llamado welcome
            return route('welcome');  // se agrega para el BLOG JACK
        }
    }
}
