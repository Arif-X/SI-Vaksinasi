<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vaksinasi;
use Auth;

class SertifikatController extends Controller
{
    public function pertama($no_sertifikat){
    	$check = Vaksinasi::where('id_user', Auth::user()->id)->where('no_sertifikat', $no_sertifikat)->where('vaksinasi_ke', 1)->first();
    	$data = Vaksinasi::where('id_user', Auth::user()->id)->where('no_sertifikat', $no_sertifikat)->where('vaksinasi_ke', 1)->get();
    	if($check){
    		return view();
    	} else {
    		return view();
    	}
    }

    public function kedua(){
    	$check = Vaksinasi::where('id_user', Auth::user()->id)->where('no_sertifikat', $no_sertifikat)->where('vaksinasi_ke', 2)->first();
    	$data = Vaksinasi::where('id_user', Auth::user()->id)->where('no_sertifikat', $no_sertifikat)->where('vaksinasi_ke', 2)->get();
    	if($check){
    		return view();
    	} else {
    		return view();
    	}
    }
}
