<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    protected $guarded = [];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function tokenPresensi()
    {
        return $this->hasMany(TokenPresensi::class);
    }

    public function presensiMahasiswa()
    {
        return $this->hasMany(PresensiMahasiswa::class);
    }
}
