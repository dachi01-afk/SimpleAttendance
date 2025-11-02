<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dosens = Dosen::with('user')->latest()->get();
        return view('admin.dosen', compact('dosens'));
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
            'nip' => 'required|unique:dosens,nip',
            'nama_dosen' => 'required',
            'prodi' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Buat user
        $user = User::create([
            'role_id' => 2,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat dosen
        Dosen::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'prodi' => $request->prodi,
        ]);


        return redirect()->back()->with('success', 'Dosen berhasil ditambahkan!');
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
    public function update(Request $request, Dosen $dosen)
    {
        session(['form' => 'edit']);
        $request->validate([
            'nip' => 'required|unique:dosens,nip,' . $dosen->id,
            'nama_dosen' => 'required',
            'prodi' => 'required',
            'email' => 'required|email|unique:users,email,' . $dosen->user_id,
        ]);

        // Update user
        $dosen->user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $dosen->user->password,
        ]);

        // Update dosen
        $dosen->update([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'prodi' => $request->prodi,
        ]);

        return redirect()->back()->with('success', 'Dosen berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {

        // Terakhir hapus dosennya
        $dosen->delete();

        return redirect()->back()->with('success', 'Dosen berhasil dihapus!');
    }
}
