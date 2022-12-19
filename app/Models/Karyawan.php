<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function toArray()
    {
        return [
            'id'=> $this->id,
            'nama'=>$this->nama,
            'email'=>$this->email,
            'umur'=>$this->umur,
            'alamat'=>$this->alamat,
            'jabatan'=>$this->jabatan,
            'foto'=>url('storage/'.$this->foto)
        ];
    }

}
