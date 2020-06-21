<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Faker\Generator as Faker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Faker $faker)
    {

        dd($faker->dateTimeThisMonth('now','PRC'));
        dd(Carbon::parse($faker->dateTimeThisMonth())->toDateTimeString());
        return view('home');
    }
}
