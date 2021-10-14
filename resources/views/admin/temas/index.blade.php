@extends('layouts.appadmin')

@section('content')
    <div class="container" style="margin-top: 150px; margin-bottom:150px">
        <button type="button" class="btn btn-info"><a href="{{ route('tema.create') }}">Nuevo Tema</a></button>
        <!-- SE CREA EL MENSAJE DE NOTIFICACION -->
        @if (session('notificacion'))
            <div class="alert alert-success" role="alert">
                {{ session('notificacion') }}
            </div>
        @endif
        @if(session('notificacion1'))
	        <div class="alert alert-success" role="alert">
	          {{session('notificacion1')}}
	        </div>
	    @endif
        <!-- SE CREA EL MENSAJE DE NOTIFICACION -->

        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Fecha de creacion</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Suscripcion</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <!-- CREACION DEL FOREACH -->
            @foreach ($temas as $tema)
                <tbody>
                    <tr>
                        <th scope="row">{{ $tema->id }}</th>
                        <td>{{ $tema->nombre }}</td>
                        <td>{{ $tema->user->name }}</td>
                        <td>{{ $tema->created_at->toDayDateTimeString() }}</td>
                        <td>{{ $tema->EsDestacado }}</td>
                        <td>{{ $tema->EsSuscripcion }}</td>
                        <td>
                            <a href="{{ route('tema.edit',$tema) }}">
                                <img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="title 1">
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('tema.delete',$tema) }}">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button style="background-color: white; border:0" type="submit">
                                    <img width="25px" src="{{ asset('imagenes/admin/eliminar.png') }}" alt="title 1">
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach

        </table>
    </div>
@endsection
