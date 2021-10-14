<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    //ESTA FUNCION DE ABAJO VIENE DEL NUCLEO DE LARAVEL
    protected function registered(Request $request, $user)
    {
        $user->roles()->sync(1);
        return  redirect($this->redirectPath());
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home'; // se cambia la ruta despues del registro por la del proyecto BLOG JACK
    protected $redirectTo = '/home';  //ADD BLOG JACK

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // CONTENIDO AGREGADO PARA BLOG JACK
        $mensaje= array(
            'name.required' => 'Campo nombre requerido',
            'name.max' => 'Ha excedido el máximo de caracteres',

            'email.required' => 'Campo email requerido',
            'email.max' => 'Ha excedido el máximo de caracteres',
            'email.unique' => 'Email ya existe en la base de datos del sistema',
            'email.email' => 'Debe ser un email valido',

            'usuario.required' => 'Campo usuario requerido',
            'usuario.min' => 'Campo Usuario demasiado corto',
            'usuario.max' => 'Ha excedido el máximo de caracteres',
            'usuario.unique' => 'El Usuario ya existe en la base de datos del sistema',

            'web.max' => 'Ha excedido el máximo de caracteres',

            'password.required' => 'Campo password requerido',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.regex' => 'Deben contener minimo 6 caracteres, al menos una mayuscula, una minuscula y caracteres especiales',
        );
        // CONTENIDO AGREGADO PARA BLOG JACK

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'usuario' =>['required', 'string', 'min:3', 'max:20','unique:users'], //AGREGADO PARA BLOG DE JACK
            'web' =>['max:20'],
           // 'password' => array(['required', 'string', 'confirmed', 'regex:/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/ '])
           'password' => ['required', 'string', 'confirmed', 'regex:/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/ '],
        ],$mensaje  //se agrega el array que se creo anteriormente
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'usuario' =>$data['usuario'],  //ADD BLOG JACK
            'web' =>$data['web'],  //ADD BLOG JACK
            'password' => Hash::make($data['password']),
        ]);
    }
}
