<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\DosenController;
use App\Http\Controllers\admin\MahasiswaController;
use App\Http\Controllers\admin\MatakuliahController;
use App\Http\Controllers\admin\JadwalKuliahController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\LaporanPresensiController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])
        ->name('admin.dashboard');

    // Resource controller untuk dosen
    Route::resource('dosens', DosenController::class);

    // Resource controller untuk mahasiswa
    Route::resource('mahasiswas', MahasiswaController::class);

    // Resource controller untuk matakuliah
    Route::resource('matakuliahs', MatakuliahController::class);

    // Resource controller untuk matakuliah
    Route::resource('jadwal_kuliahs', JadwalKuliahController::class);

    // Laporan Presensi
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/dosen',       [LaporanPresensiController::class, 'laporanPresensiDosen'])->name('presensi.dosen');
        Route::get('/mahasiswa',   [LaporanPresensiController::class, 'laporanPresensiMhs'])->name('presensi.mahasiswa');
    });
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dosen.dashboard');
    })->name('dosen.dashboard');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
});

require __DIR__ . '/auth.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

route::get('/test', function () {
    return view('contoh');
});
