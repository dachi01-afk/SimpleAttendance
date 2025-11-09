<?php

namespace App\Http\Controllers\dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PresensiDosen;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiDosenController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $presensi = PresensiDosen::where('dosen_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        return view('dosen.presensi_dosen', compact('presensi'));
    }

    public function checkIn()
    {
        $today = Carbon::today();

        // Cegah duplikasi presensi masuk
        $presensi = PresensiDosen::where('dosen_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        if ($presensi) {
            return back()->with('error', 'Anda sudah melakukan presensi hari ini.');
        }

        PresensiDosen::create([
            'dosen_id' => Auth::id(),
            'tanggal' => $today,
            'jam_masuk' => now(),
            'status' => 'hadir',
        ]);

        return back()->with('success', 'Presensi masuk berhasil!');
    }

    public function checkOut()
    {
        $presensi = PresensiDosen::where('dosen_id', Auth::id())
            ->whereDate('tanggal', Carbon::today())
            ->first();

        if (!$presensi) {
            return back()->with('error', 'Anda belum presensi masuk.');
        }

        if ($presensi->jam_pulang) {
            return back()->with('error', 'Anda sudah melakukan presensi pulang.');
        }

        $presensi->update([
            'jam_pulang' => now()
        ]);

        return back()->with('success', 'Presensi pulang berhasil!');
    }

    public function izin(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
        ]);

        PresensiDosen::create([
            'dosen_id' => Auth::id(),
            'tanggal' => Carbon::today(),
            'status' => $request->status, // sakit / izin
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Status izin/sakit berhasil dikirim!');
    }
}
