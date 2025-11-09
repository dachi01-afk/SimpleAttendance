<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\DosenController;
use App\Http\Controllers\admin\MahasiswaController;
use App\Http\Controllers\admin\MatakuliahController;
use App\Http\Controllers\admin\JadwalKuliahController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\LaporanPresensiController;
use App\Http\Controllers\dosen\DashboardDosenController;
use App\Http\Controllers\dosen\JadwalMengajarController;
use App\Http\Controllers\dosen\LaporanController;
use App\Http\Controllers\dosen\PresensiDosenController;
use App\Http\Controllers\dosen\PresensiMahasiswaController;
use App\Http\Controllers\dosen\TokenController;
use App\Http\Controllers\mahasiswa\DashboardMahasiswaController;
use App\Http\Controllers\mahasiswa\DataMatakuliahController;
use App\Http\Controllers\mahasiswa\MahasiswaPresensiController;
use App\Http\Controllers\mahasiswa\RiwayatPresensiController;

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

Route::prefix('dosen')->middleware(['auth', 'role:dosen'])->group(function () {

    // Dashboard dosen
    Route::get('/dashboard',                    [DashboardDosenController::class, 'index'])
        ->name('dosen.dashboard');


    // Dashboar jadwa mengajar
    Route::get('/jadwal_mengajar',              [JadwalMengajarController::class, 'index'])
        ->name('dosen.jadwal_mengajar');

    // Presensi Dosen
    Route::prefix('/presensi_dosen')->name('presensi_dosen.')->group(function () {
        Route::get('/', [PresensiDosenController::class, 'index'])->name('index');
        Route::post('/checkin', [PresensiDosenController::class, 'checkIn'])->name('checkin');
        Route::post('/checkout', [PresensiDosenController::class, 'checkOut'])->name('checkout');
        Route::post('/izin', [PresensiDosenController::class, 'izin'])->name('izin');
    });

    //  presensi mahasiswa
    Route::prefix('daftar_presensi_mahasiswa')->name('daftar_presensi_mahasiswa.')->group(function () {
        Route::get('/', [PresensiMahasiswaController::class, 'index'])->name('index');
        Route::get('/{jadwal_id}', [PresensiMahasiswaController::class, 'getPresensi'])->name('get');
        Route::put('/{id}/update-status', [PresensiMahasiswaController::class, 'updateStatus'])->name('updateStatus');
    });

    // Dashboar token presensi
    Route::prefix('/token_presensi')->name('token_presensi.')->group(function () {
        Route::get('/',       [TokenController::class, 'index'])->name('index');
        Route::post('/generate',   [TokenController::class, 'Generate'])->name('generate');
    });

    // Dashboar laporan presensi
    Route::get('/laporan_presensi',             [LaporanController::class, 'index'])
        ->name('dosen.laporan_presensi');
});

Route::prefix('mahasiswa')->middleware(['auth', 'role:mahasiswa'])->group(function () {
    // Dashboard mahasiswa
    Route::get('/dashboard',                    [DashboardMahasiswaController::class, 'index'])
        ->name('mahasiswa.dashboard');

    // Data matakuliah
    Route::get('/data_matakuliah',              [DataMatakuliahController::class, 'index'])
        ->name('mahasiswa.data_matakuliah');

    // presensi mahasiswa
    Route::get('/presensi_mahasiswa',                    [MahasiswaPresensiController::class, 'index'])
        ->name('mahasiswa.presensi_mahasiswa');

    // riwayat presensi
    Route::get('/riwayat_presensi',                    [RiwayatPresensiController::class, 'index'])
        ->name('mahasiswa.riwayat_presensi');
});

require __DIR__ . '/auth.php';
