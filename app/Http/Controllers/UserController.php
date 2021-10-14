<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //se crea un costructoir para proteger los formularios de algun usuario no aun}tenticado con
    //el constructor de middleware
    public function __construct(){
        $this->middleware('auth');
    }

    //actualizar
    public function update(Request $request){
        $usuarios=auth()->user();

        $messages=[
           // 'name.required' => 'Campo nombre requerido',  //ver porque no me deja guardar si agrego el required para nombre user
            'name.max' => 'Ha excedido el máximo de caracteres',

            'usuario.required' => 'Campo usuario requerido',
            'usuario.min' => 'Campo Usuario demasiado corto',
            'usuario.max' => 'Ha excedido el máximo de caracteres',
            'usuario.unique' => 'El Usuario ya existe en la base de datos del sistema',

            'web.max' => 'Ha excedido el máximo de caracteres',

            'password.required' => 'Campo password requerido',
            'password.regex' => 'Deben contener minimo 6 caracteres, al menos una mayuscula, una minuscula y caracteres especiales',
        ];

        $rules=[
            'name' => ['string', 'max:255',Rule::unique('users')->ignore($usuarios->id)],
            //'usuario' =>['required', 'string', 'min:3', 'max:20','unique:users'], //AGREGADO PARA BLOG DE JACK
            'usuario' =>['required', 'string', 'min:3', 'max:20',Rule::unique('users')->ignore($usuarios->id)],
            'web' =>['max:20'],
            'password' => ['required', 'string', 'regex:/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/ '],
        ];

        $this->validate($request, $rules, $messages);

        //return dd($usuario);
        $usuarios->name=$request->nombre;
        $usuarios->usuario=$request->usuario;
        $usuarios->web=$request->web;
        $usuarios->password=bcrypt($request->password);
        $usuarios->update();
        $notificacion='Valores actualizados correctamente';
        return back()->with(compact('notificacion'));
    }
}
