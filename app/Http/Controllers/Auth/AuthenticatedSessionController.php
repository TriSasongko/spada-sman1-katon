<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login dan redirect berdasarkan role.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses autentikasi default Laravel
        $request->authenticate();
        $request->session()->regenerate();

        // Data user
        $user = $request->user();

        /**
         * REDIRECT MULTI-ROLE
         */

        // Jika Guru
        if ($user->isGuru()) {
            return redirect()->route('guru.dashboard');
        }

        // Jika Siswa
        if ($user->isSiswa()) {
            return redirect()->route('siswa.dashboard');
        }

        // Jika Admin (default)
        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

        // Jika role tidak dikenal
        return redirect()->route('dashboard');
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
