@php($pagina ='nuevamoto')
@extends('layouts.master')

@section('titulo', 'Nueva Moto')
<h1 class="my-2">Gestor de motos Larabikes</h1>

@section('contenido')

    <form action="{{route('bikes.store')}}" enctype="multipart/form-data" class="my-2 border p-5" method="POST">
        {{csrf_field()}}
        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <input  type="text" name="marca" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{old('marca')}}">
        </div>

        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
            <input type="text" name="modelo" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{old('modelo')}}">
        </div>

        <div class="form-group row">
            <label for="inputKms" class="col-sm-2 col-form-label">Kms</label>
            <input type="number" name="kms" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{old('kms')}}">
        </div>

        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <input type="number" name="precio" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{old('precio')}}">
        </div>

        <div class="form-group row">
            <div class="form-check">
                <input name="matriculada" value="1" class="form-check-input"
                        type="checkbox" {{empty(old('matriculada')) ? "" : "checked"}}>
                <label class="formcheck-label">Matriculada</label>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control-file col-sm-10" id="inputImagen">
        </div>

        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
        </div>
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection
