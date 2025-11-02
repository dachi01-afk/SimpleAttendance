<?php

namespace App\Http\Controllers\admin;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JadwalKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = JadwalKuliah::with(['dosen', 'mataKuliah', 'kelas'])->latest()->get();
        $dosens = Dosen::all();
        $matakuliahs = MataKuliah::all();
        $kelas = Kelas::all();

        return view('admin.jadwal_kuliah', compact('jadwals', 'dosens', 'matakuliahs', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session(['form' => 'add']);

        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'kelas_id' => 'required|exists:kelas,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);

        JadwalKuliah::create($request->all());

        return redirect()->back()->with('success', 'Jadwal kuliah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalKuliah $jadwalKuliah)
    {
        session(['form' => 'edit']);

        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'kelas_id' => 'required|exists:kelas,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'semester' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);

        $jadwalKuliah->update($request->all());

        return redirect()->back()->with('success', 'Jadwal kuliah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKuliah $jadwalKuliah)
    {
        $jadwalKuliah->delete();
        return redirect()->back()->with('success', 'Jadwal kuliah berhasil dihapus!');
    }
}
