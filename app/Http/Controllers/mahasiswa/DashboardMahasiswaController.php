<?php

namespace App\Http\Controllers\mahasiswa;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use App\Models\JadwalMahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data mahasiswa berdasarkan user_id
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Statistik cepat
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalKelas = Kelas::count();
        $totalMataKuliah = MataKuliah::count();

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




        // Jadwal kuliah mahasiswa hari ini (BERDASARKAN KELAS)
        $jadwals = JadwalKuliah::with(['dosen', 'mataKuliah', 'kelas'])
            ->where('kelas_id', $mahasiswa->kelas_id)
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai')
            ->get();

        return view('mahasiswa.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalKelas',
            'totalMataKuliah',
            'namaHari',
            'jadwals'
        ));
    }
}
