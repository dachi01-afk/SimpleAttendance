<?php

namespace App\Http\Controllers\dosen;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardDosenController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMataKuliah = MataKuliah::count();
        $totalKelas = Kelas::count();

        // Ambil hari ini (misalnya "Senin", "Selasa", dll)
        $hariIni = Carbon::now()->locale('id')->dayName;
        $hariIni = ucfirst($hariIni); // kapital huruf pertama biar sesuai di DB

        // Ambil jadwal kuliah hari ini
        $jadwals = JadwalKuliah::with(['dosen', 'mataKuliah', 'kelas'])
            ->where('hari', $hariIni)
            ->get();

        // Kirim data ke view
        return view('dosen.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMataKuliah',
            'totalKelas',
            'jadwals',
            'hariIni'
        ));
    }
}
