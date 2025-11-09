<?php

namespace App\Http\Controllers\dosen;

use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalMengajarController extends Controller
{
    public function index()
    {
        // Ambil dosen yang sedang login
        // $dosen = auth()->user()->dosen;
        $dosen = Auth::user()->dosen;

        // Ambil jadwal berdasarkan dosen yang login
        $jadwals = JadwalKuliah::with(['mataKuliah', 'kelas'])
            ->where('dosen_id', $dosen->id)
            ->orderBy('hari', 'asc')
            ->get();

        return view('dosen.jadwal_mengajar', compact('jadwals'));
    }
}
