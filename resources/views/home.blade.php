@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="m-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>{{ __('You are logged in!') }}</p>
                    <p><span class="fw-bold">Nom d'usuari:</span> {{Auth::user()->name}}</p>
                    <p><span class="fw-bold">Email:</span> {{Auth::user()->email}}</p>
                    @if(Auth::user()->location)
                        <p><span class="fw-bold">Location:</span> {{Auth::user()->location}}</p>
                    @endif
                </div>
            </div>

            <table class="table table-striped table-bordered my-5">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matrícula</th>
                    <th>Color</th>
                    <th>Operaciones</th>
                </tr>

                @forelse($bikes as $bike)
                    <tr>
                        <td>{{ $bike->id }}</td>
                        <td class="text-center" style="max-width: 80px">
                            <img class="rounded" style="max-width: 80%"
                                alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                                title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                                src="{{
                                        $bike->imagen?
                                        asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                                        asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'
                                    }}">
                        </td>
                        <td>{{ $bike->marca }}</td>
                        <td>{{ $bike->modelo }}</td>
                        <td>{{ $bike->matrícula }}</td>
                        <td style="background-color: {{ $bike->color }}">{{ $bike->color }}</td>
                        <td class="text-center">
                            <a href="{{route('bikes.show', $bike->id)}}">
                                <img    src="{{asset('images/buttons/show.png')}}"
                                        alt="Ver detalles" title="Ver detalles"
                                        height="20" width="20">
                            </a>
                            @auth
                                @if(Auth::user()->can('update', $bike))
                                    <a href="{{route('bikes.edit', $bike->id)}}">
                                        <img    src="{{asset('images/buttons/update.png')}}"
                                                alt="Modificar" title="Modificar"
                                                height="20" width="20">
                                    </a>
                                @endif

                                @if(Auth::user()->can('delete', $bike))
                                    <a href="{{route('bikes.delete', $bike->id)}}">
                                        <img    src="{{asset('images/buttons/delete.png')}}"
                                                alt="Borrar" title="Borrar"
                                                height="20" width="20">
                                    </a>
                                @endif
                            @endauth
                        </td>
                    </tr>
                    @if($loop->last)
                    <tr>
                        <td colspan="7">Mostrando {{sizeof($bikes)}} de {{$total}}.</td>
                    </tr>
                    @endif
                @empty
                <tr>
                    <td colspan="7">No hay motos para mostrar</td>
                </tr>
                @endforelse
            </table>

            <h3 class="mt-4">Motos borradas</h3>
            <table class="table table-striped table-bordered my-3">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matrícula</th>
                    <th>Color</th>
                    <th>Operaciones</th>
                </tr>

                @forelse($deletedBikes as $bike)
                    <tr>
                        <td>{{ $bike->id }}</td>
                        <td class="text-center" style="max-width: 80px">
                            <img class="rounded" style="max-width: 80%"
                                alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                                title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                                src="{{
                                        $bike->imagen?
                                        asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                                        asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'
                                    }}">
                        </td>
                        <td>{{ $bike->marca }}</td>
                        <td>{{ $bike->modelo }}</td>
                        <td>{{ $bike->matrícula }}</td>
                        <td style="background-color: {{ $bike->color }}">{{ $bike->color }}</td>
                        <td class="text-center">
                            <a href="{{ route('bikes.restore', $bike->id) }}">
                                <button class="btn btn-success">Restaurar</button>
                            </a>
                            <form method="POST" action="{{ route('bikes.purgue') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="bike_id" value="{{ $bike->id }}">
                                <input type="submit" alt="Borrar" title="Eliminar"
                                    class="btn btn-danger" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                    @if($loop->last)
                    <tr>
                        <td colspan="7">Mostrando {{sizeof($bikes)}} de {{$total}}.</td>
                    </tr>
                    @endif
                @empty
                <tr>
                    <td colspan="7">No hay motos para mostrar</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection
