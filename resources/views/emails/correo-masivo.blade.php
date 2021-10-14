@component('mail::message')
# Introduction
# Hola {{ $usuario->name }}

{!! $contenido !!}

@component('mail::button', ['url' => config('app.url') ])
Ir al Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
