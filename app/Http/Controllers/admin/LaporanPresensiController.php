<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PresensiDosen;
use App\Models\PresensiMahasiswa;
use Illuminate\Http\Request;

class LaporanPresensiController extends Controller
{
    public function laporanPresensiDosen()
    {

        $presensiDosen = PresensiDosen::with(['dosen'])->latest()->get();
        return view('admin.laporan_presensi_dosen', compact('presensiDosen'));
    }

    public function laporanPresensiMhs()
    {
        $presensiMhs = PresensiMahasiswa::with(['mahasiswa', 'dosen', 'jadwalKuliah',])->latest()->get();
        return view('admin.laporan_presensi_mhs', compact('presensiMhs'));
    }
}
