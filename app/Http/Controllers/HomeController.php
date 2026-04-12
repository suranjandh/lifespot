<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        if (Auth::check()){
          return  redirect('/login');
        }
        return view('project.home.index');
    }

    public function webspot(){
        return view('project.home.webspot');
    }

    public function advanced_markets(){
        return view('project.home.advanced_markets');

    }

    public function advanced_resources(){
        return view('project.home.advanced_resources');

    }

    public function test(){
        $task = new Task();
        return $task->tasks_on_dashboard();
        //return view('test');
    }
}
