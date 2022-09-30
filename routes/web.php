<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])
    ->name('portada');


Route::resource('bikes', BikeController::class);

Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
        ->name('bikes.delete');

Route::get('bikes/{marca}/{modelo?}', [BikeController::class, 'search'])
        ->where('bike',);

Route::any('/shop', function(Request  $request){
    echo "Estás realizando la petición por " . $request->method();
});

Route::redirect('/tienda', '/shop', 301);

Route::fallback([WelcomeController::class, 'index']);



Route::get('saludar/portada', function() {
    return "PORTADA";
});
