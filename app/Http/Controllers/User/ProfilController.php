<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profil;
use Auth;

class ProfilController extends Controller
{
    public function index(){
    	$data = Profil::join('users', 'users.id', '=', 'profil.id_user')
    	->join('role', 'role.id_role', '=', 'users.role')    	
    	->where('users.id', Auth::user()->id)
    	->select(
    		'users.email',
    		'role.nama_role',
    		'profil.*'
    	)
    	->get();
    	return view('user.profil', ['datas' => $data]);
    }
}
