@extends('layouts.master')

@section('titulo', "Confirmación de borrado de $bike->marca $bike->modelo")

@section('contenido')
    <form  class="my-2 border p-5" method="POST"
            action="{{URL::temporarySignedRoute('bikes.destroy', now()->addMinutes(1), $bike->id)}}">
        {{ csrf_field() }}
        <input type="hidden" value="DELETE" name="_method">
        <figure>
            <figcaption>Imagen actual</figcaption>
            <img src="{{ $bike->imagen ?
                        asset('storage/' . config('filesystems.bikesImageDir')) . '/'.$bike->imagen:
                        asset('storage/' . config('filesystems.bikesImageDir')) . '/default.jpg' }}"
                title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                class="rounded" style="max-width: 400px">
        </figure>

        <label for="confirmdelete">Confirma el borrado de {{"$bike->marca $bike->modelo"}}</label>
        <input type="submit" class="btn btn-danger m-4" alt="Borrar" title="Borrar"
                value="Borrar" id="confirmdelete">
    </form>
@endsection

@section('enlaces')
    @parent
        <div href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</div>
        <div href="{{route('bikes.show', $bike->id)}}" class="btn btn-primary m-2">Regresar a detalles de la moto</div>
@endsection
