@extends('layouts.app')
@section('title') {{ $tema->nombre }}  @endsection

@section('content')

<section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 150px; padding-bottom: 80px;">

    @if ($userAutenticado && !$userBloqueado && $userVerificado)

        <div class="container-fluid">
            <div class="col-xs-12 col-lg-4">
                <h1>{{ $tema->nombre }}</h1>
            </div>

            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                    @foreach ($articulos as $articulo)
                        <div class="col-xs-12 col-lg-4">
                            <div class="jsNewsCard news__card" modal-id="{{ $articulo->id }}">
                                <div class="news__image">
                                    <img class="news__img" alt="" src="{{ Storage::url('imageArticle/' .$articulo->imagenDestacada()) }}">  <!-- MUETRA IMAGEN POR ARTICULO -->
                                </div>

                                <div class="news__inner">
                                    <h5 class="mbr-section-title display-6">{{ $articulo->titutlo }}</h5>
                                    <p class="mbr-section-text lead">{!! $articulo->contenido !!}</p>
                                    <div class="news__date">
                                        <span class="cm-icon cm-icon-clock"></span>
                                        <p>{{ $articulo->created_at->diffForHumans() }}</p>  <!-- la fecha es hace cuanto se publico-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- PAGINATOR-->
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                    {{ $articulos->links() }}
                </div>
            </div>

        </div>

        <!-- MODAL -->
        @foreach ($articulos as $articulo)
            <div data-app-prevent-settings="" class="modal fade" tabindex="-1" data-keyboard="true" data-interval="false" id="{{ $articulo->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="news__card" href="{{ $articulo->id }}">

                            @if ($articulo->images->first())
                                <div class="news__image">
                                    @foreach ($articulo->images as $imagen)
                                    <img class="news__img" alt="" src="{{ Storage::url('imageArticle/' .$imagen->nombre) }}">
                                    @endforeach
                                </div>
                            @endif

                                <div class="news__inner">
                                    <h5 class="mbr-section-title display-6"> {{ $articulo->titutlo }}</h5>
                                    <p class="mbr-section-text lead">{!! $articulo->contenido !!}</p>

                                    <div class="news__date">
                                        <span class="cm-icon cm-icon-clock"></span>
                                        <p>{{ $articulo->created_at->format('d-m-Y') }}</p> <!-- la fecha es por dia mes y año-->
                                    </div>

                                    <a class="close" href="#" role="button" data-dismiss="modal">
                                        <span aria-hidden="true">×</span>
                                        <span class="sr-only">Close</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @elseif(!$userAutenticado)
        <div style="width: 500px; margin:20px auto 50px auto;">
            <div class="alert-heading">
                <h4>Para perro!!</h4>
                <p>No eres usuario VIP, debes suscribirte y luego iniciar sesion</p>
                <hr>
                <p class="mb-0"> <a href="{{ route('register') }}">Suscribirse</a> </p>
            </div>
        </div>

    @elseif($userBloqueado)
        <div style="width: 500px; margin:20px auto 50px auto;">
            <div class="alert-heading">
                <h4>Para perro!!</h4>
                <p>Estas BLOQUEADO!! xD</p>
            </div>
        </div>
    @endif

    @elseif(!$userVerificado)
        <div style="width: 500px; margin:20px auto 50px auto;">
            <div class="alert-heading">
                <h4>Para perro!!</h4>
                <p>Tu correo no esta verificado!! xD</p>
            </div>
        </div>
    @endif
</section>

@include('includes.login-modal') <!-- SE INCLUYE LA VISTA DEL  MODAL del login -->
@endsection

@if ($errors->any())
    @section('include-login-modal')
        <script src="{{ asset('js/login-modal.js') }}"></script><!-- SE AGREGA NUEVO .JS  -->
    @endsection
@endif

