<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\TempatVaksin;

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
    public function home()
    {
        if(Auth::user()->role == 1){
            return redirect("/admin/jenis-vaksin");
        } elseif(Auth::user()->role >= 2) {
            return redirect("/user/profil");
        }
    }

    public function index(){
        $koordinats = TempatVaksin::get();

        return view('index', ['koordinats' => $koordinats]);
    }
}
