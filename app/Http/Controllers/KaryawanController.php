<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::paginate(10);
        return response()->json([
            'data'=>$karyawan
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $karyawan = Karyawan::create([
            'nama'=>$request->nama,
            'email'=>$request->email,
            'umur'=>$request->umur,
            'alamat'=>$request->alamat,
            'jabatan'=>$request->jabatan,
            'foto'=>$request->foto
        ]);
        return response()->json([
            'data'=>$karyawan
        ]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        return response()->json([
            'data'=>$karyawan
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $karyawan=Karyawan::findOrFail($id);
        $karyawan->nama=$request->nama;
        $karyawan->email=$request->email;
        $karyawan->umur=$request->umur;
        $karyawan->alamat=$request->alamat;
        $karyawan->jabatan=$request->jabatan;
        $karyawan->foto=$request->foto;
        $karyawan->update();

        return response()->json([
            'data'=>$karyawan
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return response()->json([
            'message' => 'Karyawan Deleted'
        ],200);
    }
}
