@extends('welcome')

<h1 class="my-2">Gestor de motos Larabikes</h1>


@section('main')
        <h2>Listado de motos</h2>

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        {{-- <form method="POST" action="{{route('bikes.search')}}" class="col-4 d-flex flex-row">
            {{csrf_field()}}
            <input name="marca" type="text" class="col form-control m-2"
                    placeholder="Marca" maxlength="16" required
                    value="{{empty($marca) ? '' : $marca}}">

            <input name="modelo" type="text" class="col form-control m-2"
                    placeholder="Modelo" maxlength="16" required
                    value="{{empty($modelo) ? '' : $modelo}}">
            <button type="submit" class="col btn btn-primary m-2">Buscar</button>
        </form> --}}

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

            @forelse($bikes as $bike)
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
                            <img    src="{{asset('images/buttons/update.png')}}"
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
                @if($loop->last)
                <tr>
                    <td colspan="4">Mostrando {{sizeof($bikes)}} de {{$total}}.</td>
                </tr>
                @endif
            @empty
            <tr>
                <td colspan="4">No hay motos para mostrar</td>
            </tr>
            @endforelse
        </table>
        <div class="btn-group" role="group" label="Links">
            <a href="{{url('/')}}" class="btn btn-primary mr-2">Inicio</a>
        </div>
    @endsection

