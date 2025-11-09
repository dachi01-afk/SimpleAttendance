<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaPresensiController extends Controller
{
    public function index()
    {
        return view('mahasiswa.presensi_mahasiswa');
    }
}
