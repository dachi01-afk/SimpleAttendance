<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelas')->insert([
            ['id' => 1, 'nama_kelas' => 'IF-3A'],
            ['id' => 2, 'nama_kelas' => 'SI-2B'],
            ['id' => 3, 'nama_kelas' => 'IF-3B'],
            ['id' => 4, 'nama_kelas' => 'MI-1B'],
            ['id' => 5, 'nama_kelas' => 'TK-1A'],
        ]);
    }
}
