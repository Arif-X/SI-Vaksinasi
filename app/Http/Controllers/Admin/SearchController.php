<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\TempatVaksin;
use App\Pevaksin;

class SearchController extends Controller
{
	function user(Request $request){
		if($request->get('query')){
			$query = $request->get('query');
			$data = User::join('profil', 'profil.id_user', '=', 'users.id')
			->select('users.email', 'profil.nama')
			->where('profil.nama', 'LIKE', "%{$query}%")			
			->get();
			$output = '';
			if($data){
				foreach($data as $row){
					$output .= '
					<a href="#" id="li-user" class="dropdown-item"><li>' . $row->nama . ' * ' . $row->email . '</li></a>';
				}
				$output .= '';
				echo $output;
			}			
		}
	}

	function tempat(Request $request){
		if($request->get('query')){
			$query = $request->get('query');
			$data = TempatVaksin::where('nama_tempat', 'LIKE', "%{$query}%")
			->get();
			$output = '';
			if($data){
				foreach($data as $row){
					$output .= '
					<a href="#" id="li-tempat" class="dropdown-item"><li>' . $row->nama_tempat . ' - ' . $row->alamat . '</li></a>';
				}
				$output .= '';
				echo $output;
			}			
		}
	}

	function pevaksin(Request $request){
		if($request->get('query')){
			$query = $request->get('query');
			$data = Pevaksin::join('users', 'users.id', '=', 'pevaksin.id_user')
			->join('profil', 'profil.id_user', '=', 'users.id')
			->where('profil.nama', 'LIKE', "%{$query}%")
			->get();
			$output = '';
			if($data){
				foreach($data as $row){
					$output .= '
					<a href="#" id="li-pevaksin" class="dropdown-item"><li>' . $row->nama . ' * ' . $row->email . '</li></a>';
				}
				$output .= '';
				echo $output;
			}			
		}
	}
}
