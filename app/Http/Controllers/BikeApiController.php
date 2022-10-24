<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiCreateBikeRequest;
use App\Http\Requests\ApiUpdateBikeRequest;
use App\Models\Bike;
use Illuminate\Http\Request;

class BikeApiController extends Controller
{
    public function index() {
        $motos = Bike::orderBy('id', 'DESC')->get();

        return [
            'status' => 'OK',
            'total' => count($motos),
            'results' => $motos
        ];
    }

    public function show($id) {
        $moto = Bike::find($id);
        return $moto ?
            [
                'status' => 'OK',
                'results' => [$moto]
            ]:
            response(['status' => 'NOT FOUND'], 404);
    }

    public function search($campo = 'marca', $valor = '') {
        $motos = Bike::where($campo, 'LIKE', "%$valor%")->get();

        return [
            'status' => 'OK',
            'total' => count($motos),
            'results' => $motos
        ];
    }

    public function store(ApiCreateBikeRequest $request) {
        $datos = $request->json()->all();
        $datos['imagen'] = NULL;
        $datos['user_id'] = NULL;

        $moto = Bike::created($datos);

        return $moto ?
            response([
                'status' => 'OK',
                'results' => [$moto]
            ], 201):
            response([
                'status' => 'ERROR',
                'message' => 'No se pudo guardar.'
            ], 400);
    }

    public function update(ApiUpdateBikeRequest $request, $id) {
        $moto = Bike::find($id);
        if(!$moto)
            return response(['status' => 'NOT FOUND'], 404);
        $datos = $request->json()->all();
        return $moto->update($datos) ?
            response([
                'status' => 'OK',
                'results' => [$moto]
            ], 200) :
            response([
                'status' => 'ERROR',
                'message' => 'No se pudo actualizar.'
            ], 400);
    }

    public function delete($id) {
        $moto = Bike::find($id);
        if(!$moto)
            return response(['status' => 'NOT FOUND'], 404);
        return $moto->delete() ?
            response(['status' => 'OK']) :
            response([
                'status' => 'ERROR',
                'message' => 'No se pudo eliminar.'
            ], 400);
    }
}
