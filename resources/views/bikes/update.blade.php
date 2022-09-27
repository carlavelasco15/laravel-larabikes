@extends('welcome')
<h1 class="my-2">Gestor de motos Larabikes</h1>

@section('main')
    <h2>Actualización de la moto {{"$bike->marca $bike->modelo"}}</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    <form action="{{route('bikes.update', $bike->id)}}" class="my-2 border p-5" method="POST">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PUT">

        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <input  type="text" name="marca" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{$bike->marca}}">
        </div>

        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo prova</label>
            <input type="text" name="modelo" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{$bike->modelo}}">
        </div>

        <div class="form-group row">
            <label for="inputKms" class="col-sm-2 col-form-label">Kms</label>
            <input type="number" name="kms" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{$bike->kms}}">
        </div>

        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <input type="number" name="precio" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{$bike->precio}}">
        </div>

        <div class="form-group row">
            <div class="form-check">
                <input name="matriculada" value="1" class="form-check-input"
                        type="checkbox" {{$bike->matriculada ? "" : "checked"}}>
                <label class="formcheck-label">Matriculada</label>
            </div>
        </div>

        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
        </div>
    </form>

    <div class="text-end my-3">
        <div class="btn-group mx-2">
            <a href="{{route('bikes.show', $bike->id) }}" class="mx-2">
                <img height="40" width="40" src="{{asset('images/buttons/show.png')}}"
                        alt="Borrar" title="Borrar">

            </a>
        </div>
    </div>

    <div class="btn-group" role="group" aria-label="Links">
        <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
        <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
    </div>
@endsection
