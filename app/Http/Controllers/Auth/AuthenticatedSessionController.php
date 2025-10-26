<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Gagal mendapatkan data pengguna.',
            ]);
        }

        // if ($user->role->name_role === 'admin') {
        //     return redirect()->route('admin.dashboard');
        // } elseif ($user->role->name_role === 'dosen') {
        //     return redirect()->route('dosen.dashboard');
        // } elseif ($user->role->name_role === 'mahasiswa') {
        //     return redirect()->route('mahasiswa.dashboard');
        // }

        // // fallback jika role tidak terdefinisi
        // return redirect()->route('login')->withErrors(['role' => 'Role pengguna tidak dikenal.']);
        // redirect berdasarkan role
        switch ($user->role->name_role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'dosen':
                return redirect()->route('dosen.dashboard');
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'role' => 'Role pengguna tidak dikenali.',
                ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
