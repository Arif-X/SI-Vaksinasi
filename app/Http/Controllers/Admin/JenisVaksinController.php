<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JenisVaksin;
use Yajra\DataTables\DataTables;

class JenisVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisVaksin::get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_jenis_vaksin.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editData">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_jenis_vaksin.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.jenis-vaksin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = JenisVaksin::where('id_jenis_vaksin', $request->vaksin_id)->first();
        if(empty($check)){
            JenisVaksin::create([
                'nama_vaksin' => $request->nama
            ]);
        }else{
            JenisVaksin::where('id_jenis_vaksin', $request->vaksin_id)->update([
                'nama_vaksin' => $request->nama
            ]);
        }        
        return response()->json(['success'=>'Jenis Vaksin Disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenisVaksin = JenisVaksin::where('id_jenis_vaksin', $id)->get();
        return response()->json($jenisVaksin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisVaksin::where('id_jenis_vaksin', $id)->delete();
        return response()->json(['success'=>'Jenis Vaksin Dihapus.']);
    }
}
