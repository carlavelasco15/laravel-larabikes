@extends('welcome')
<h1 class="my-2">Gestor de motos Larabikes</h1>


@section('contenido')
    <h2>Detalles de la moto {{"$bike->marca $bike->modelo"}}</h2>

    <table class="table table-striped table-bordered">
        <tr>
            <td>ID</td>
            <td>{{$bike->id}}</td>
        </tr>
        <tr>
            <td>Marca</td>
            <td>{{$bike->marca}}</td>
        </tr>
        <tr>
            <td>Modelo</td>
            <td>{{$bike->modelo}}</td>
        </tr>
        <tr>
            <td>Marca</td>
            <td>{{$bike->marca}}</td>
        </tr>
        <tr>
            <td>Precio</td>
            <td>{{$bike->precio}}</td>
        </tr>
        <tr>
            <td>Kms</td>
            <td>{{$bike->kms}}</td>
        </tr>
        <tr>
            <td>Matriculada</td>
            <td>{{$bike->matriculada ? 'SI' : 'NO'}}</td>
        </tr>
        <tr>
            <td>Imagen</td>
            <td class="text-start">
                <img class="rounded" style="max-width: 400px"
                    alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                    title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                    src="{{
                            $bike->imagen?
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                            asset('storage/'.config('filesystems.bikesimageDir')).'/default.jpg'
                        }}">
            </td>
        </tr>
    </table>
    <div class="text-end my-3">
        <div class="btn-group mx-2">
            <a href="{{route('bikes.edit', $bike->id) }}" class="mx-2">

                <img    src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"
                        height="40" width="40">
            </a>

            <a href="{{ route('bikes.delete', $bike->id) }}" class="mx-2">

                <img    src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"
                        height="40" width="40">
            </a>
        </div>
    </div>

    <div class="btn-group" role="group" aria-label="Links">
        <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
    </div>
@endsection
