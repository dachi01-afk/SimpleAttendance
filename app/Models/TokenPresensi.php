<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenPresensi extends Model
{
    protected $guarded = [];

    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function presensiMahasiswa()
    {
        return $this->hasMany(PresensiMahasiswa::class);
    }
}
