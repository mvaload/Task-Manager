<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class IndexController extends Controller
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
        $myTasks = auth()->user()->tasks;
        return view('index', ['myTasks' => $myTasks]);
    }
}
