<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     // User::factory()->create([
    //     //     'name' => 'Test User',
    //     //     'email' => 'test@example.com',
    //     // ]);
    // }

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DosenSeeder::class,
            KelasSeeder::class,
            MahasiswaSeeder::class,
            MataKuliahSeeder::class,
            JadwalKuliahSeeder::class,
            TokenPresensiSeeder::class,
            PresensiMahasiswaSeeder::class,
            PresensiDosenSeeder::class,
            JadwalMahasiswaSeeder::class,
        ]);
    }
}
