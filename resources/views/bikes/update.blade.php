@extends('welcome')

@section('contenido')
    <h2>Actualización de la moto {{"$bike->marca $bike->modelo"}}</h2>

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

        <div class="form-group row my-3">
            <div class="form-check">
                <input name="matriculada" value="1" class="form-check-input"
                        type="checkbox" {{$bike->matriculada ? "checked" : "unchecked"}}>
                <label class="formcheck-label">Matriculada</label>
            </div>
        </div>

        <div class="form-check col-sm-6">
            <label for="inputMatricula" class="col-sm-2 form-label">Matrícula</label>
            <input type="text" class="up form-control" name="matricula"
                    id="inputMatricula" maxlength="7" value="{{ $bike->matricula }}">
        </div>

        <div class="form-group col-sm-6">
            <label for="confirmMatricula" class="col-sm-2 form-label">Repetir</label>
            <input type="text" class="up form-control" name="matricula_confirmation" id="confirmMatricula"
                maxlength="7" value="{{ $bike->matricula }}">
        </div>

        <script>
            inputMatricula.disabled = !chkMatriculada.checked;

            chkMatriculada.onchange = function() {
                inputMatricula.disabled = !chkMatriculada.checked;
            }
        </script>

        <div class="form-group row">
            <div class="form-check col-sm-6">
                <input type="checkbox" class="form-check-input"
                        id="chkColor" {{ $bike->color ? 'checked' : ''}}>
                <label class="form-check-label">Indicar el color</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputColor" class="col-sm-2 form-label">Color</label>
                <input type="color" class="up form-control form-control-color" name="color"
                    id="inputColor" value="{{ $bike->color ?? '#FFFFFF' }}">
            </div>
        </div>

        <script>
            inputColor.disabled = !chkColor.checked;

            chkColor.onchange = function() {
                inputcolor.disabled = !chkColor.checked;
            }

        </script>

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
