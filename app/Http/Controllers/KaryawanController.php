<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Services\KaryawanService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Intervention\Image\Facades\Image;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawanService = new KaryawanService();
        $karyawan = $karyawanService->getAllKaryawan();

        return response()->json([[
            'data'=>$karyawan
        ]]);
    }

    /**
     * Store a newly created resource    in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $karyawanService = new KaryawanService();
        $karyawan = $karyawanService->store($request->all());

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
        $karyawanService = new KaryawanService();
        $karyawan = $karyawanService->update($request,$id);

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
