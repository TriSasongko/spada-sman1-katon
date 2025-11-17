<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Opsional, tetapi baik untuk kejelasan

class GuruDashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // Verifikasi Peran (Lapisan Keamanan Tambahan)
        if (!$user->isGuru()) {
            // Jika bukan Guru, tolak akses
            abort(403, 'Akses ditolak. Anda bukan Guru.');
        }

        // Ambil data Guru melalui relasi yang ada di Model User
        // Asumsi: Relasi guru() sudah didefinisikan di App\Models\User
        $guru = $user->guru;

        // Tampilkan view dashboard Guru
        return view('dashboard.guru', compact('guru'));
    }
}
