<?php

namespace App\Http\Controllers;
use App\Models\Classroom;


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
         $classrooms=Classroom::get();

        return view('home',['classrooms'=>$classrooms]);
    }
}
