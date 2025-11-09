<?php

namespace App\Http\Controllers\dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\JadwalKuliah;
use App\Models\TokenPresensi;
use App\Models\PresensiMahasiswa;

class PresensiMahasiswaController extends Controller
{
    public function index()
    {
        $dosenId = Auth::user()->dosen->id; // ✅ perbaikan akses id
        $jadwal_dosen = JadwalKuliah::with(['mataKuliah', 'kelas'])
            ->where('dosen_id', $dosenId)
            ->get();

        return view('dosen.daftar_presensi_mahasiswa', compact('jadwal_dosen'));
    }

    // ✅ Fetch data presensi berdasarkan jadwal yang dipilih dan tanggal hari ini
    public function getPresensi($jadwal_id)
    {
        $hariIni = Carbon::today();

        // Cari token aktif hari ini berdasarkan jadwal dosen
        $tokenAktif = TokenPresensi::where('jadwal_id', $jadwal_id)
            ->whereDate('waktu_mulai', $hariIni)
            ->latest()
            ->first();

        if (!$tokenAktif) {
            return response()->json(['data' => []]);
        }

        // Ambil data presensi mahasiswa berdasarkan token tersebut
        $presensi = PresensiMahasiswa::with('mahasiswa')
            ->where('token_id', $tokenAktif->id)
            ->get();

        return response()->json(['data' => $presensi]);
    }

    // ✅ Update status presensi mahasiswa
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:hadir,sakit,izin,alpha',
        ]);

        $presensi = PresensiMahasiswa::findOrFail($id);
        $presensi->status = $request->status;
        $presensi->save();

        return response()->json(['success' => true]);
    }
}
