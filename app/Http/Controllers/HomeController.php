<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
//        if(Auth::user()->role == 2){
//            $page_title = 'View Attendence';
//            return view('teacher-view',compact('page_title'));
//        }
        $page_title = 'Home';
        return view('dashboard',compact('page_title'));
    }
}
