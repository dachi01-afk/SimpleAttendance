<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PresensiMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('presensi_mahasiswas')->insert([
            ['id' => 1, 'mahasiswa_id' => 1, 'dosen_id' => 1, 'jadwal_kuliah_id' => 1, 'token_id' => 1, 'tanggal' => '2025-10-18', 'waktu_presensi' => now()->subMinutes(5), 'status' => 'hadir', 'keterangan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'mahasiswa_id' => 2, 'dosen_id' => 2, 'jadwal_kuliah_id' => 2, 'token_id' => 2, 'tanggal' => '2025-10-17', 'waktu_presensi' => '2025-10-17 09:15:00', 'status' => 'hadir', 'keterangan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'mahasiswa_id' => 3, 'dosen_id' => 3, 'jadwal_kuliah_id' => 3, 'token_id' => 3, 'tanggal' => '2025-10-16', 'waktu_presensi' => '2025-10-16 10:05:00', 'status' => 'izin', 'keterangan' => 'Izin karena sakit', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'mahasiswa_id' => 4, 'dosen_id' => 4, 'jadwal_kuliah_id' => 4, 'token_id' => 4, 'tanggal' => '2025-10-18', 'waktu_presensi' => '2025-10-18 13:10:00', 'status' => 'hadir', 'keterangan' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'mahasiswa_id' => 5, 'dosen_id' => 5, 'jadwal_kuliah_id' => 5, 'token_id' => 5, 'tanggal' => '2025-10-15', 'waktu_presensi' => '2025-10-15 08:30:00', 'status' => 'alpha', 'keterangan' => 'Tidak hadir tanpa keterangan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
