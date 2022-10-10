@php($pagina ='portada')
@extends('layouts.master')

@section('titulo', 'Portada de Larabikes')

@section('contenido')
    <figure class="row mt-2 mb-2 col-10 offset-1">
        <img    class="d-block w-100"
                src="{{asset('images/bikes/bike0.png')}}"
                alt="Moto de Candela en Akira">
    </figure>
@endsection

@section('enlaces')
@endsection
