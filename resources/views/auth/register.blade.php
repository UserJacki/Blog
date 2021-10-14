@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin-top: 150px; margin-bottom:70px" class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <!-- SE AGREGA UN NUEVO DIV PARA LOS MENSAJES DE VALIDACION -->
                @if ($errors->any())
                <div class="alert alert-danger" >
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- SE AGREGA UN NUEVO DIV PARA LOS MENSAJES DE VALIDACION -->

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- NOMBRE -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                       <!-- <strong>  $errors->first('name  </strong> arroja el primer error para el campo name -->
                                        @foreach ($errors->get('name') as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- NOMBRE END-->

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        @foreach ($errors->get('email') as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- EMAIL -->

                        <!--  SE AGEGAN NUEVOS VALORES PARA EL BLOG DE JACK  -->
                        <div class="form-group row">
                            <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>

                            <div class="col-md-6">
                                <input id="usuario" type="usuario" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" placeholder="Min 3, Max 20">
                                @if ($errors->has('usuario'))
                                    <span class="invalid-feedback" role="alert">
                                        @foreach ($errors->get('usuario') as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="web" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                            <div class="col-md-6">
                                <input id="web" type="web" class="form-control{{ $errors->has('web') ? ' is-invalid' : '' }}" name="web" value="{{ old('web') }}" >
                                @if ($errors->has('web'))
                                    <span class="invalid-feedback" role="alert">
                                        @foreach ($errors->get('web') as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--  SE AGEGAN NUEVOS VALORES PARA EL BLOG DE JACK FIN  -->

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        @foreach ($errors->get('password') as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
