<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use App\Models\TokenPresensi;
use App\Models\PresensiMahasiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MahasiswaPresensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        // Hari ini dalam angka (1 = Senin, 7 = Minggu)
        $hariIni = Carbon::now()->dayOfWeekIso;

        $jadwalHariIni = JadwalKuliah::with(['mataKuliah', 'dosen'])
            ->where('kelas_id', $mahasiswa->kelas_id)
            ->where('hari', $hariIni)
            ->get();

        return view('mahasiswa.presensi_mahasiswa', compact('jadwalHariIni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'jadwal_id' => 'required|exists:jadwal_kuliahs,id',
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $token = TokenPresensi::where('token', $request->token)
            ->where('jadwal_id', $request->jadwal_id)
            ->where('status', 'aktif')
            ->where('waktu_mulai', '<=', Carbon::now())
            ->where('waktu_selesai', '>=', Carbon::now())
            ->first();

        if (!$token) {
            return back()->with('error', 'Token tidak valid atau sudah kedaluwarsa.');
        }

        // Cegah presensi ganda
        $sudahPresensi = PresensiMahasiswa::whereDate('tanggal', Carbon::today())
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('jadwal_kuliah_id', $request->jadwal_id)
            ->exists();

        if ($sudahPresensi) {
            return back()->with('warning', 'Anda sudah melakukan presensi hari ini.');
        }

        // Simpan presensi
        PresensiMahasiswa::create([
            'mahasiswa_id' => $mahasiswa->id,
            'dosen_id' => $token->dosen_id,
            'jadwal_kuliah_id' => $request->jadwal_id,
            'token_id' => $token->id,
            'tanggal' => Carbon::today(),
            'waktu_presensi' => Carbon::now(),
            'status' => 'hadir',
        ]);

        return back()->with('success', 'Presensi berhasil disimpan.');
    }
}
