<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMataKuliah = MataKuliah::count();
        $totalKelas = Kelas::count();

        // Hari ini dalam angka (1-7)
        $hariIni = Carbon::now()->dayOfWeekIso;

        // Untuk tampilan teks
        $namaHari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ][$hariIni];

        // Ambil jadwal kuliah hari ini
        $jadwals = JadwalKuliah::with(['dosen', 'mataKuliah', 'kelas'])
            ->where('hari', $hariIni)
            ->get();

        // Kirim data ke view
        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMataKuliah',
            'totalKelas',
            'jadwals',
            'namaHari'
        ));
    }
}
