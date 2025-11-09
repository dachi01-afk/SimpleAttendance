<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenPresensi extends Model
{
    protected $guarded = [];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        // Tambahkan kolom tanggal lain jika ada (misal: 'created_at', 'updated_at' jika Anda perlu memformatnya)
    ];

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
