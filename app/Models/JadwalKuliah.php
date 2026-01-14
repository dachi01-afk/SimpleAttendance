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

    // Relasi ke Mahasiswa (Many-to-Many)
    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'jadwal_mahasiswas', 'jadwal_kuliah_id', 'mahasiswa_id')
            ->withTimestamps();
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tokenPresensi()
    {
        return $this->hasMany(TokenPresensi::class);
    }

    public function presensiMahasiswa()
    {
        return $this->hasMany(PresensiMahasiswa::class);
    }

    public function getNamaHariAttribute()
    {
        return [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ][$this->hari] ?? '-';
    }
}
