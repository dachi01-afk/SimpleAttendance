<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataMatakuliahController extends Controller
{
    public function index()
    {
        return view('mahasiswa.data_matakuliah');
    }
}
