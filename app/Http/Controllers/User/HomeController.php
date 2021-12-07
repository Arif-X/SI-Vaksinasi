<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index(){
    	if(Auth::user()->role == 1){
    		return redirect("/admin/jenis-vaksin");
    	} elseif(Auth::user()->role >= 2) {
    		return redirect("/user/profil");
    	}
    }
}
