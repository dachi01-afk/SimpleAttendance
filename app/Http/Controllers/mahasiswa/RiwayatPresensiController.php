<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatPresensiController extends Controller
{
    public function index()
    {
        return view('mahasiswa.riwayat_presensi');
    }
}
