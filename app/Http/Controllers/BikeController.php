<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Http\Requests\BikeRequest;

class BikeController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('index', 'show', 'search');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bikes = Bike::orderBy('id', 'DESC')->paginate(10);
        return view('bikes.list', [
            'bikes' => $bikes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BikeRequest $request)
    {
        $datos = $request->only(['marca', 'modelo', 'precio', 'kms', 'matriculada', 'matricula', 'color']);

        $datos += ['imagen' => NULL];

        if($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store(config('filesystems.bikesImageDir'));
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        $bike = Bike::create($datos);

        return redirect()
                ->route('bikes.show', $bike->id)
                ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente")
                ->cookie('lastInsertID', $bike->id, 0);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $bike = Bike::findOrFail($id);
        return view('bikes.show', [
            'bike'=>$bike
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bike = Bike::findOrFail($id);
        return view('bikes.update', [
            'bike' => $bike,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bike = Bike::findOrFail($id);
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => ['required', 'max:255', new \App\Rules\Mayusculas()],
            'precio' => 'required|numeric|min:0',
            'kms' => 'required|integer|min:0',
            'matriculada' => 'required_with:matricula',
            'matricula' => "required_if:matriculada,1|
                            nullable|
                            regex:/^\d{4}[B-Z]{3}$/i|
                            unique:bikes,matricula,$bike->id",
            'color' => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ]);

        $datos = $request->only('marca', 'modelo', 'kms', 'precio');

        $datos['matriculada'] = $request->has('matriculada') ? 1 : 0;
        $datos['matricula'] = $request->has('matriculada') ? $request->input('matricula') : NULL;
        $datos['color'] = $request->input('color') ?? NULL;

        $bike->update($datos);

        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada");
    }

    public function delete($id) {
        $bike = Bike::findOrFail($id);
        return view('bikes.delete', [
            'bike' => $bike
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->delete();

        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada.");
    }


    public function search(Request $request){
        $request->validate([
            'marca' => 'required|max:16',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ]);


        $datos = $request->only(['marca', 'modelo', 'precio', 'kms', 'matriculada']);

        $datos += ['imagen' => NULL];

        if($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store(config('finesystems.bikesImageDir'));
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        $bike = Bike::create($datos);

        return redirect()
                ->route('bikes.show', $bike->id)
                ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente")
                ->cookie('lastInsertID', $bike->id, 0);
    }
}
