@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 100px; background-color: rgb(200, 147, 207)">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <form method="POST" action="{{ route('actualizaruser') }}">
            @csrf
                {{ method_field('PUT') }}
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
                @if (session('notificacion'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notificacion') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="exampleInputName">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') ?? auth()->user()->name }}" >
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Password</label>
                    <input type="password" class="form-control" name="password"  placeholder="Introduce tu vieja contraseña">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Usuario</label>
                    <input type="text" class="form-control" name="usuario" value="{{  old('usuario') ?? auth()->user()->usuario }}" placeholder="Nombre Usuario">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">web</label>
                    <input type="text" class="form-control" name="web" value="{{  old('web') ?? auth()->user()->web }}" placeholder="Web">
                </div>

                <button type="submit" class="btn btn-info btn-sm">Actualizar</button>
              </form>
        </div>
    </div>
</div>
@endsection
