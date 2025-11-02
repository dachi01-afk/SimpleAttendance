<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_mahasiswas')->insert([
            ['jadwal_kuliah_id' => 1, 'mahasiswa_id' => 1],
            ['jadwal_kuliah_id' => 1, 'mahasiswa_id' => 2],
            ['jadwal_kuliah_id' => 2, 'mahasiswa_id' => 3],
        ]);
    }
}
