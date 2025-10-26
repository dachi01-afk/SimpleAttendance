<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiMahasiswa extends Model
{
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class);
    }

    public function tokenPresensi()
    {
        return $this->belongsTo(TokenPresensi::class);
    }
}
