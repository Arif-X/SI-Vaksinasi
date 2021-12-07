<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempatVaksin;
use App\Pevaksin;
use App\User;
use App\Vaksinasi;
use Auth;

class TestController extends Controller
{
    public function index(){
        

       $checkUser = Vaksinasi::where('id_user', 6)->where('vaksinasi_ke', 2)->first();
       $checkId = Vaksinasi::where('id_vaksinasi', 13)->where('vaksinasi_ke', 2)->first();

       if(empty($checkId) ||empty($checkUser))
            echo "kapok";
        else
        	echo $checkUser;
    }
}
