<?php

namespace App\Http\Controllers\dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\JadwalKuliah;
use App\Models\TokenPresensi;
use Carbon\Carbon;

class TokenController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;

        // Otomatis ubah token yang sudah lewat jadi "kedaluwarsa"
        TokenPresensi::where('status', 'aktif')
            ->where('waktu_selesai', '<', Carbon::now())
            ->update(['status' => 'kedaluwarsa']);

        // Ambil semua jadwal dosen
        $jadwals = JadwalKuliah::with(['mataKuliah', 'kelas'])
            ->where('dosen_id', $dosen->id)
            ->get();

        // Ambil token aktif terakhir
        $tokenAktif = TokenPresensi::where('dosen_id', $dosen->id)
            ->where('status', 'aktif')
            ->where('waktu_selesai', '>', Carbon::now())
            ->latest()
            ->first();

        return view('dosen.token_presensi', compact('jadwals', 'tokenAktif'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_kuliahs,id',
            'durasi' => 'required|integer|min:1',
        ]);

        $dosen = Auth::user()->dosen;

        // Nonaktifkan token aktif sebelumnya untuk jadwal yang sama
        TokenPresensi::where('dosen_id', $dosen->id)
            ->where('jadwal_id', $request->jadwal_id)
            ->where('status', 'aktif')
            ->update(['status' => 'nonaktif']);

        // Buat token baru (6 karakter huruf kapital)
        $token = strtoupper(Str::random(6));

        $waktuMulai = Carbon::now();
        $waktuSelesai = Carbon::now()->addMinutes($request->integer('durasi'));

        // Simpan token
        TokenPresensi::create([
            'jadwal_id' => $request->jadwal_id,
            'dosen_id' => $dosen->id,
            'token' => $token,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'status' => 'aktif',
        ]);

        return redirect()->route('token_presensi.index')->with('success', "Token berhasil dibuat: $token");
    }
}
