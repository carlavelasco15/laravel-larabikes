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
        $bikes = $request->user()->bikes()->paginate(config('pagination.bikes', 10));

        $deletedBikes = $request->user()->bikes()->onlyTrashed()->get();

        return view('home', ['bikes' => $bikes, 'deletedBikes' => $deletedBikes]);
    }
}
