<?php

namespace App\Http\Controllers\Pevaksin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vaksinasi;
use App\TempatVaksin;
use App\JenisVaksin;
use App\Pevaksin;
use App\User;
use App\Profil;
use DataTables;
use Str;
use Auth;


class VaksinasiKeduaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if($request->ajax()){
    		$getIdPevaksin = Pevaksin::join('users', 'users.id', '=', 'pevaksin.id_user')
    		->where('users.email', Auth::user()->email)->value('id_pevaksin');

    		$data = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
    		->join('profil', 'profil.id_user', '=', 'users.id')
    		->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
    		->join('tempat_vaksin', 'tempat_vaksin.id_tempat_vaksin', '=', 'vaksinasi.id_tempat_vaksin')
    		->join('pevaksin', 'pevaksin.id_pevaksin', '=', 'vaksinasi.id_pevaksin')
    		->join('users as pevaksin_user', 'pevaksin_user.id', '=', 'pevaksin.id_user')
    		->join('profil as pevaksin_profil', 'pevaksin_profil.id_user', '=', 'pevaksin_user.id')
    		->select('vaksinasi.id_vaksinasi', 
    			'vaksinasi.tanggal_vaksin', 
    			'vaksinasi.vaksinasi_ke', 
    			'users.email', 
    			'profil.*', 
    			'jenis_vaksin.nama_vaksin',
    			'tempat_vaksin.nama_tempat',
    			'pevaksin_profil.nama as nama_pevaksin'
    		)
    		->where('vaksinasi.vaksinasi_ke', 2)
    		->where('vaksinasi.id_pevaksin', $getIdPevaksin)
    		->get();
    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('action', function($row){

    			$btn = ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_vaksinasi.'" data-original-title="Edit" class="btn btn-primary btn-sm editData">Edit</a>';

    			$btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_vaksinasi.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';

    			return $btn;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

        // $tempat_vaksin = TempatVaksin::pluck('nama_tempat', 'id_tempat_vaksin');
    	$tempat_vaksin = TempatVaksin::select('nama_tempat', 'alamat', 'id_tempat_vaksin')->get(0);
    	$jenis_vaksin = JenisVaksin::pluck('nama_vaksin', 'id_jenis_vaksin');

    	return view('pevaksin.vaksinasi-kedua', compact('tempat_vaksin', 'jenis_vaksin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
    	$userRequest = $request->get_user;
    	$userData = strstr($userRequest, '* ', false);      
    	$userEmail = str_replace('* ', '', $userData);
        // Get User Id
    	$getIdUser = User::where('email', $userEmail)->value('id');

    	$getIdPevaksin = Pevaksin::join('users', 'users.id', '=', 'pevaksin.id_user')
    	->where('users.email', Auth::user()->email)->value('id_pevaksin');

        // Get Alamat
    	$alamatRequest = $request->get_tempat;
    	$alamat = strstr($alamatRequest, '- ', false);
    	$getAlamat = str_replace('- ', '', $alamat);

        // Get Nama Tempat
    	$namaTempat = strstr($alamatRequest, ' -', true);
    	$getTempat = str_replace(' -', '', $namaTempat);

        // Get ID Tempat Vaksin
    	$tempatVaksin = TempatVaksin::where('alamat', $getAlamat)->where('nama_tempat', $getTempat)->value('id_tempat_vaksin');

    	$checkId = Vaksinasi::where('id_vaksinasi', $request->id_vaksinasi)->where('vaksinasi_ke', 2)->first();
    	$checkUser = Vaksinasi::where('id_user', $getIdUser)->where('vaksinasi_ke', 2)->first();

    	if(empty($checkId) || empty($checkUser)){
    		Vaksinasi::create([
    			'no_sertifikat' => Str::random(11),
    			'id_user' => $getIdUser,
    			'id_jenis_vaksin' => $request->jenis_vaksin,
    			'id_tempat_vaksin' => $tempatVaksin,
    			'id_pevaksin' => $getIdPevaksin,
    			'tanggal_vaksin' => $request->tanggal,
    			'vaksinasi_ke' => 2
    		]);
    	} else {
    		Vaksinasi::where('id_vaksinasi', $request->id_vaksinasi)->where('vaksinasi_ke', 2)->update([
    			'id_jenis_vaksin' => $request->jenis_vaksin,
    			'id_tempat_vaksin' => $tempatVaksin,
    			'id_pevaksin' => $getIdPevaksin,
    			'tanggal_vaksin' => $request->tanggal,
    		]);
    	}        
    	return response()->json(['success'=>'Vaksinasi Disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$getIdPevaksin = Pevaksin::join('users', 'users.id', '=', 'pevaksin.id_user')
        ->where('users.email', Auth::user()->email)->value('id_pevaksin');

    	$data = Vaksinasi::join('users', 'users.id', '=', 'vaksinasi.id_user')
    	->join('profil', 'profil.id_user', '=', 'users.id')
    	->join('jenis_vaksin', 'jenis_vaksin.id_jenis_vaksin', '=', 'vaksinasi.id_jenis_vaksin')
    	->join('tempat_vaksin', 'tempat_vaksin.id_tempat_vaksin', '=', 'vaksinasi.id_tempat_vaksin')
    	->join('pevaksin', 'pevaksin.id_pevaksin', '=', 'vaksinasi.id_pevaksin')
    	->join('users as pevaksin_user', 'pevaksin_user.id', '=', 'pevaksin.id_user')
    	->join('profil as pevaksin_profil', 'pevaksin_profil.id_user', '=', 'pevaksin_user.id')
    	->select('vaksinasi.id_vaksinasi', 
    		'vaksinasi.tanggal_vaksin', 
    		'vaksinasi.vaksinasi_ke', 
    		'users.email', 
    		'profil.*', 
    		'jenis_vaksin.nama_vaksin',
    		'tempat_vaksin.nama_tempat',
    		'tempat_vaksin.alamat as alamat_vaksin',
    		'pevaksin_profil.nama as nama_pevaksin',
    		'pevaksin_user.email as email_pevaksin'
    	)
    	->where('vaksinasi.vaksinasi_ke', 2)
    	->where('vaksinasi.id_pevaksin', $getIdPevaksin)
    	->where('vaksinasi.id_vaksinasi', $id)
    	->get();

    	return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$getIdPevaksin = Pevaksin::join('users', 'users.id', '=', 'pevaksin.id_user')
        ->where('users.email', Auth::user()->email)->value('id_pevaksin');

    	$vaksinasi = Vaksinasi::where('id_vaksinasi', $id)->where('vaksinasi.id_pevaksin', $getIdPevaksin)->delete();
    	return response()->json(['success'=>'Data Vaksinasi Dihapus.']);
    }
}
