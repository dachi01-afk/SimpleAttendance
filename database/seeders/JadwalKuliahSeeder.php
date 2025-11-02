<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JadwalKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_kuliahs')->insert([
            ['id' => 1, 'dosen_id' => 1, 'mata_kuliah_id' => 1, 'kelas_id' => 1, 'hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'semester' => 'Ganjil', 'tahun_ajaran' => '2025/2026', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'dosen_id' => 2, 'mata_kuliah_id' => 3, 'kelas_id' => 2, 'hari' => 'Selasa', 'jam_mulai' => '09:00', 'jam_selesai' => '11:00', 'semester' => 'Ganjil', 'tahun_ajaran' => '2025/2026', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'dosen_id' => 3, 'mata_kuliah_id' => 2, 'kelas_id' => 3, 'hari' => 'Rabu', 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'semester' => 'Ganjil', 'tahun_ajaran' => '2025/2026', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'dosen_id' => 4, 'mata_kuliah_id' => 4, 'kelas_id' => 4, 'hari' => 'Kamis', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'semester' => 'Ganjil', 'tahun_ajaran' => '2025/2026', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'dosen_id' => 5, 'mata_kuliah_id' => 5, 'kelas_id' => 5, 'hari' => 'Jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'semester' => 'Ganjil', 'tahun_ajaran' => '2025/2026', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
