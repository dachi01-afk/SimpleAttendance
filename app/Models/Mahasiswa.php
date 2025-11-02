<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Jadwal (Many-to-Many)
    public function jadwalKuliahs()
    {
        return $this->belongsToMany(JadwalKuliah::class)
            ->withTimestamps();
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function presensiMahasiswa()
    {
        return $this->hasMany(PresensiMahasiswa::class);
    }
}
