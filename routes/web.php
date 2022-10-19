<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use App\Models\Bike;

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
Route::delete('/bikes/purgue', [BikeController::class, 'purgue'])
    ->name('bikes.purgue');

Route::get('/bikes/{bike}/restore', [BikeController::class, 'restore'])
    ->name('bikes.restore');

Route::get('/', [WelcomeController::class, 'index'])
->name('portada');

Route::get('/bikes/search', [BikeController::class, 'search'])
    ->name('bikes.search');

Route::resource('bikes', BikeController::class);

Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])
        ->name('bikes.delete');

Route::fallback([WelcomeController::class, 'index']);

Route::get('/contacto', [ContactoController::class, 'index'])
    ->name('contacto');

Route::post('/contacto', [ContactoController::class, 'send'])
    ->name('contacto.email');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Auth::routes(['verify' => true]);


