<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pevaksin;
use App\User;
use App\Vaksinasi;
use DataTables;

class PevaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Pevaksin::join('users', 'users.id', '=', 'pevaksin.id_user')
            ->join('profil', 'profil.id_user', '=', 'users.id')
            ->select('pevaksin.id_pevaksin', 'users.email', 'profil.*')
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_pevaksin.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.pevaksin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emailRequest = $request->get_user;
        $email = strstr($emailRequest, '* ', false);      
        $userEmail = str_replace('* ', '', $email);

        $getId = User::where('email', $userEmail)->value('id');

        $check = Pevaksin::where('id_user', $getId)->first();

        $checkVaksinasiKedua = Vaksinasi::where('id_user', $getId)->where('vaksinasi_ke', 2)->first();

        if(empty($check)){
            if(!empty($checkVaksinasiKedua)){
                Pevaksin::create([
                    'id_user' => $getId
                ]);

                User::where('id', $getId)->update([
                    'role' => 2
                ]);
                return response()->json(['success'=>'Pevaksin Disimpan.']);
            } else {
                return response()->json(['error'=>'Pevaksin Tidak Disimpan.']);
            }
        } else {
            return response()->json(['error'=>'Pevaksin Sudah Ada.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pevaksin = Pevaksin::join('users', 'users.id', '=', 'pevaksin.id_user')
        ->join('profil', 'profil.id_user', '=', 'pevaksin.id_user')
        ->select('profil.nama', 'users.email', 'pevaksin.id_pevaksin')
        ->where('id_pevaksin', $id)
        ->get();
        return response()->json($pevaksin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pevaksin::where('id_pevaksin', $id)->delete();
        return response()->json(['success'=>'Pevaksin Dihapus.']);
    }
}
