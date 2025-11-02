<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMahasiswa extends Model
{
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class);
    }
}
