<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        /* dd($request->user()->email_verified_at); */
        $bikes = $request->user()->bikes();
        /* dd($request->user()->hasMany('\\App\\Models\\Bike')); */

        return view('home', ['bikes' => $bikes]);
    }
}
