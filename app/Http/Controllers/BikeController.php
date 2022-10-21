<?php

namespace App\Http\Controllers;

use App\Events\FirstBikeCreated;
use Illuminate\Http\Request;
use App\Models\Bike;
use App\Http\Requests\BikeRequest;
use Illuminate\Support\Facades\Storage;

class BikeController extends Controller
{
    public function __construct() {
        $this->middleware('verified')->except('index', 'show', 'search');
        $this->middleware('password.confirm')->only('destroy');
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
        $datos['user_id'] = $request->user()->id;
        $bike = Bike::create($datos);
        if($request->user()->bikes->count() == 1)
            FirstBikeCreated::dispatch($bike, $request->user());
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
    public function show(Bike $bike)
    {
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
    public function edit(Request $request, Bike $bike)
    {
        if($request->user()->cant('update', $bike))
                abort(401, 'No puedes borrar una moto que no es tuya');
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
    public function update(Request $request, Bike $bike)
    {
        if($request->user()->cant('update', $bike))
                abort(401, 'No puedes borrar una moto que no es tuya');
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => ['required', 'max:255'],
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
        if ($request->hasFile('imagen'))
        {
            if ($bike->imagen)
                $aBorrar = config('filesystems.bikesImageDir') . '/' . $bike->imagen;
            $imagenNueva = $request->file('imagen')->store(config('filesystems.bikesImageDir'));
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }
        if ($request->filled('eliminarimagen') && $bike->imagen) {
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.bikesImageDir') . '/' . $bike->imagen;
        }
        if ($bike->update($datos)) {
            if(isset($aBorrar))
                Storage::delete($aBorrar);
        } else {
            if(isset($imagenNueva))
                Storage::delete($imagenNueva);
        }
        $bike->update($datos);
        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada");
    }

    public function delete(Request $request, Bike $bike) {
        if($request->user()->cant('delete', $bike))
            abort(401, 'No puedes borrar una moto que no es tuya');
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
    public function destroy(Request $request, Bike $bike)
    {
        if($request->user()->cant('delete', $bike))
            abort(401, 'No puedes borrar una moto que no es tuya');
        $bike->delete();
        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada.");
    }

    public function purgue(Request $request)
    {
        $bike = Bike::withTrashed()->find($request->input('bike_id'));
        if($request->user()->cant('delete', $bike))
            abort(401, 'No puedes borrar una moto que no es tuya');
        if($bike->forceDelete() && $bike->imagen)
            Storage::delete(config('filesystems.bikesImageDir').'/'.$bike->imagen);

        return back()->with(
            'success',
            "Moto $bike->marca $bike->modelo eliminada definitivamente."
        );
    }

    public function search(Request $request){
        $request->validate(['marca' => 'max:16', 'modelo' => 'max:16']);
        $marca = $request->input('marca', 'a');
        $modelo = $request->input('modelo', 'b');
        $bikes = Bike::where('marca', 'like', "%$marca%")
                        ->where('modelo', 'like', "%$modelo%")
                        ->paginate(config('paginator.bikes'))
                        ->appends(['marca' => $marca, 'modelo' => $modelo]);
        return view('bikes.list', ['bikes' => $bikes, 'marca' => $marca, 'modelo' => $modelo]);
    }

    public function restore(int $id)
    {
        $bike = Bike::withTrashed()->find($id);
        $bike->restore();
        return back()->with(
            'success',
            "Moto $bike->marca $bike->modelo restaurada correctamente."
        );
    }
}
