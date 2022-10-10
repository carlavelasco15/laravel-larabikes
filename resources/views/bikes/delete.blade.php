@extends('layouts.master')

@section('titulo', "Confirmación de borrado de $bike->marca $bike->modelo")

@section('contenido')
    <form action="{{route('bikes.destroy', $bike->id)}}" class="my-2 border p-5" method="POST">
        {{ csrf_field() }}
        <input type="hidden" value="DELETE" name="_method">

        <label for="cinformdelete">Confirma el borrado de {{"$bike->marca $bike->modelo"}}</label>
        <input type="submit" class="btn btn-danger m-4" alt="Borrar" title="Borrar"
                value="Borrar" id="confirmdelete">
    </form>
@endsection

@section('enlaces')
    @parent
        <div href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</div>
        <div href="{{route('bikes.show', $bike->id)}}" class="btn btn-primary m-2">Regresar a detalles de la moto</div>
@endsection
