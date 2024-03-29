@extends('welcome')

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
            <td>Propietario</td>
            <td>{{$bike->user ? $bike->user->name : 'Sin propietario'}}</td>
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
        @if($bike->matriculada)
        <tr>
            <td>Matrícula</td>
            <td>{{$bike->matricula}}</td>
        </tr>
        @endif
        @if($bike->color)
        <tr>
            <td>Color</td>
            <td style="background-color: {{ $bike->color }}">{{ $bike->color }}</td>
        </tr>
        @endif
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
            @auth
                @if(Auth::user()->can('update', $bike))
                    <a href="{{route('bikes.edit', $bike->id) }}" class="mx-2">

                        <img    src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"
                                height="40" width="40">
                    </a>
                @endif

                @if(Auth::user()->can('delete', $bike))
                    <a href="{{ route('bikes.delete', $bike->id) }}" class="mx-2">

                        <img    src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"
                                height="40" width="40">
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="btn-group" role="group" aria-label="Links">
        <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
    </div>
@endsection
