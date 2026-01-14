<?php

namespace App\Http\Controllers\mahasiswa;

use Illuminate\Http\Request;
use App\Models\JadwalMahasiswa;
use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use Illuminate\Support\Facades\Auth;

class DataMatakuliahController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(403);
        }

        $jadwals = JadwalKuliah::with(['mataKuliah', 'kelas', 'dosen'])
            ->where('kelas_id', $mahasiswa->kelas_id)
            ->get();

        return view('mahasiswa.data_matakuliah', compact('jadwals'));
    }
}
