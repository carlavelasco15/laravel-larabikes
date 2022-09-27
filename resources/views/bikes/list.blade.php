@extends('welcome')

<h1 class="my-2">Gestor de motos Larabikes</h1>


@section('main')
        <h2>Listado de motos</h2>

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <div class="row">
            <div class="col-6 text-start">{{ $bikes->links() }}</div>
            <div class="col-6 text-end">
                <p> Nueva moto <a href="{{route('bikes.create')}}" class="btn btn-success ml-2">+</a></p>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Operaciones</th>
            </tr>

            @foreach($bikes as $bike)
                <tr>
                    <td>{{ $bike->id }}</td>
                    <td>{{ $bike->marca }}</td>
                    <td>{{ $bike->modelo }}</td>
                    <td class="text-center">
                        <a href="{{route('bikes.show', $bike->id)}}">
                            <img    src="{{asset('images/buttons/show.png')}}"
                                    alt="Ver detalles" title="Ver detalles"
                                    height="20" width="20">
                        </a>

                        <a href="{{route('bikes.edit', $bike->id)}}">
                            <img    src="{{asset('images/buttons/edit.png')}}"
                                    alt="Modificar" title="Modificar"
                                    height="20" width="20">
                        </a>

                        <a href="{{route('bikes.delete', $bike->id)}}">
                            <img    src="{{asset('images/buttons/delete.png')}}"
                                    alt="Borrar" title="Borrar"
                                    height="20" width="20">
                        </a>

                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Mostrando {{sizeof($bikes)}} de {{$total}}.</td>
            </tr>
        </table>
        <div class="btn-group" role="group" label="Links">
            <a href="{{url('/')}}" class="btn btn-primary mr-2">Inicio</a>
        </div>
    @endsection

