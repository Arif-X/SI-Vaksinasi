<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TempatVaksin;
use Yajra\DataTables\DataTables;

class TempatVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TempatVaksin::get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_tempat_vaksin.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editData">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_tempat_vaksin.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';

                return $btn;
            })
            ->addColumn('map', function($row){

                $btn = '<a href="/mapbb" data-toggle="tooltip"  data-id="'.$row->id_tempat_vaksin.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editData">Edit</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.tempat-vaksin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = TempatVaksin::where('id_tempat_vaksin', $request->tempat_id)->first();
        if(empty($check)){
            TempatVaksin::create([
                'nama_tempat' => $request->nama,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }else{
            TempatVaksin::where('id_tempat_vaksin', $request->tempat_id)->update([
                'nama_tempat' => $request->nama,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
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
        $tempatVaksin = TempatVaksin::where('id_tempat_vaksin', $id)->get();
        return response()->json($tempatVaksin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TempatVaksin::where('id_tempat_vaksin', $id)->delete();
        return response()->json(['success'=>'Tempat Vaksin Dihapus.']);
    }
}
