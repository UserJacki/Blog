@extends('layouts.app')

@section('content')

<section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 150px; padding-bottom: 80px;">

    <div class="container-fluid">

        <div class="row">

            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                <p>No molestes, este tema no existe,
                    ...

                    VETE
                </p>
            </div>

        </div>
    </div>



</section>

@include('includes.login-modal') <!-- SE INCLUYE LA VISTA DEL  MODAL del login -->
@endsection

@if ($errors->any())
    @section('include-login-modal')
        <script src="{{ asset('js/login-modal.js') }}"></script><!-- SE AGREGA NUEVO .JS  -->
    @endsection
@endif

