<?php

namespace App\Http\Controllers\dosen;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PresensiDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = PresensiDosen::where('dosen_id', Auth::id());

        // Filter tanggal
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        } else {
            // default: tampilkan 30 hari terakhir
            $query->where('tanggal', '>=', Carbon::today()->subDays(30));
        }

        $presensis = $query->orderBy('tanggal', 'desc')->get();

        return view('dosen.laporan_presensi', compact('presensis'));
    }
}
