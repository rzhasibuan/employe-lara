<?php 

namespace App\Services;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanService
{
    public function getAllKaryawan()
    {
        $karyawan = Karyawan ::paginate(10);
        return $karyawan;
    }


public function store(array $data)
{
    $karyawan = Karyawan::create([
        'nama'=>$data['nama'],
        'email'=>$data['email'],
        'umur'=>$data['umur'],
        'alamat'=>$data['alamat'],
        'jabatan'=>$data['jabatan'],
        'foto'=>$data['foto']->store('file/','public')
    ]);
    return $karyawan;
}

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
    return $karyawan;
}
}

