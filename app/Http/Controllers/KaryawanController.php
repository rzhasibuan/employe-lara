<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
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
        $karyawan = Karyawan::paginate(10);
        return response()->json([
            'data'=>$karyawan
        ]);
    }
    /**
     * Store a newly created resource    in storage.
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
            'foto'=>$request->file('foto')->store('file/','public')
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
       $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'umur' => 'required|numeric',
        'alamat' => 'required',
        'jabatan' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $karyawan = Karyawan :: findOrFail($id);
    
    if($request->hasFile('foto')){
        $image = $request->file('foto');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);
        $karyawan->foto = $name;
    }

    $data = [
        "nama"=>$request->nama,
        "email"=>$request->email,
        "umur"=>$request->umur,
        "alamat"=>$request->alamat,
        "jabatan"=>$request->jabatan
    ];
    if($request->hasFile('foto')){
        $image = file_get_contents($request->foto);
        $image_base64 = base64_encode($image);
        $data['foto'] = $image_base64;
    }
    $karyawan->update($data);
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
