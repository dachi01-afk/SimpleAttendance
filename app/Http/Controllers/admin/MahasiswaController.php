<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with('user', 'kelas')->latest()->get();
        $kelas = Kelas::latest()->get();
        return view('admin.mahasiswa', compact('mahasiswas', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session(['form' => 'add']);
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required',
            'prodi' => 'required',
            'kelas_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Buat user
        $user = User::create([
            'role_id' => 2,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'prodi' => $request->prodi,
            'kelas_id' => $request->kelas_id,
        ]);


        return redirect()->back()->with('success', 'data berhasil ditambahkan!');
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
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        session(['form' => 'edit']);
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama_mahasiswa' => 'required',
            'prodi' => 'required',
            'kelas_id' => 'required',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user_id,
        ]);

        // Update user
        $mahasiswa->user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $mahasiswa->user->password,
        ]);

        // Update mahasiswa
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'prodi' => $request->prodi,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {

        // Terakhir hapus mahasiswanya
        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
