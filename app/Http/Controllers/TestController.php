<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempatVaksin;
use App\Pevaksin;
use App\User;
use App\Vaksinasi;
use DateTime;
use DateInterval;
use Auth;

class TestController extends Controller
{
	public function index(){
		$getTanggalVaksinPertama = Vaksinasi::where('id_user', 6)->where('vaksinasi_ke', 1)->value('tanggal_vaksin');
		
		$date = new DateTime($getTanggalVaksinPertama);
		$date->add(new DateInterval('P30D'));
		echo $date->format('Y-m-d');	

		$now = date("Y-m-d");

		if($now > $date->format('Y-m-d')){
			echo "sudah perlu";
		} else {
			echo "belum";
		}
	}
}
