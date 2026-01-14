<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\PresensiMahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatPresensiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil mahasiswa berdasarkan user
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        $query = PresensiMahasiswa::with([
            'jadwalKuliah.mataKuliah'
        ])
            ->where('mahasiswa_id', $mahasiswa->id);

        // Filter tanggal dari
        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }

        // Filter tanggal sampai
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        // Filter mata kuliah
        if ($request->filled('matkul')) {
            $query->whereHas('jadwalKuliah', function ($q) use ($request) {
                $q->where('mata_kuliah_id', $request->matkul);
            });
        }

        $presensis = $query->orderBy('tanggal', 'desc')->get();

        // Mata kuliah (optional: bisa difilter berdasarkan kelas mahasiswa)
        $matkuls = MataKuliah::all();

        return view('mahasiswa.riwayat_presensi', compact(
            'presensis',
            'matkuls'
        ));
    }
}
