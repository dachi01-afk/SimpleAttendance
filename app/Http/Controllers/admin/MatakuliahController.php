<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $matakuliahs = MataKuliah::latest()->get();
        return view('admin.matakuliah', compact('matakuliahs'));
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
            'kode_mk' => 'required|unique:mata_kuliahs,kode_mk',
            'nama_mk' => 'required',
            'sks' => 'required|integer',
        ]);

        // Buat matkul
        MataKuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
        ]);


        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
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
    public function update(Request $request, MataKuliah $matakuliah)
    {
        session(['form' => 'edit']);
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs,kode_mk,' . $matakuliah->id,
            'nama_mk' => 'required',
            'sks' => 'required|integer',
        ]);

        // Update matakuliah
        $matakuliah->update([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $matakuliah)
    {

        // Terakhir hapus dosennya
        $matakuliah->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
