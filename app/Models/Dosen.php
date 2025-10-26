<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class);
    }

    public function presensiDosen()
    {

        return $this->hasMany(PresensiDosen::class);
    }

    public  function presensiMahasiswa()
    {
        return $this->hasMany(PresensiMahasiswa::class);
    }
}
