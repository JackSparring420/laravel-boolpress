<?php

namespace App\Http\Controllers;
use App\Car;

use Illuminate\Http\Request;

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
    public function index()
    {
        return view('pages.home');
    }

    public function cars() {

        $cars = Car::all();

        // dd($comics);

        return view('pages.cars', compact('cars'));
    }

    public function create() {

        return view('pages.create');
    }

  

    public function store(Request $request) {

        $data = $request -> validate([
            'name' => 'required|string|max:255',
            'manifacture' => 'string|max:255',
            'displacement' => 'numeric',
        ]);

        $car = Car::create($data);

        // return redirect() -> route('home');

        return redirect() -> route('cars', $car -> id);
    }
}
