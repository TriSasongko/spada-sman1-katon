<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Opsional, tetapi baik untuk kejelasan

class SiswaDashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // Verifikasi Peran (Lapisan Keamanan Tambahan)
        if (!$user->isSiswa()) {
            // Jika bukan Siswa, tolak akses
            abort(403, 'Akses ditolak. Anda bukan Siswa.');
        }

        // Ambil data Siswa melalui relasi yang ada di Model User
        // Asumsi: Relasi siswa() sudah didefinisikan di App\Models\User
        $siswa = $user->siswa;

        // Tampilkan view dashboard Siswa
        return view('dashboard.siswa', compact('siswa'));
    }
}
