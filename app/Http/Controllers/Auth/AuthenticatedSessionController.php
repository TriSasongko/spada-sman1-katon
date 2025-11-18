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
     * Halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login dan redirect berdasarkan role
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses autentikasi Laravel
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        // Redirect sesuai role (TIDAK pakai /home)
        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return redirect('/admin'); // Filament admin
        }

        if (method_exists($user, 'isGuru') && $user->isGuru()) {
            return redirect()->route('guru.dashboard'); // Dashboard guru
        }

        if (method_exists($user, 'isSiswa') && $user->isSiswa()) {
            return redirect()->route('siswa.dashboard'); // Dashboard siswa
        }

        // Fallback jika role tidak cocok
        abort(403, 'Role tidak valid');
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
