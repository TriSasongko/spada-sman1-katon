<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root → langsung ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔹 Login utama Laravel
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

// Middleware auth
Route::middleware('auth')->group(function () {

    // -----------------------------
    // Dashboard Siswa
    // -----------------------------
    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])
        ->name('siswa.dashboard');

    // -----------------------------
    // Dashboard Guru (Filament)
    // -----------------------------
    Route::get('/guru', [GuruDashboardController::class, 'index'])
        ->name('guru.dashboard');

    // -----------------------------
    // Redirect multi-role setelah login
    // -----------------------------
    Route::get('/home', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        if ($user->role === 'guru') {
            return redirect('/guru');
        }

        if ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        abort(403, 'Role tidak valid');
    })->name('home');

    // -----------------------------
    // Logout
    // -----------------------------
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// -----------------------------
// OVERRIDE LOGOUT FILAMENT - TAMBAHKAN INI
// -----------------------------
Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('filament.admin.auth.logout');

// Routes untuk auth lainnya (register, forgot password, dsb)
require __DIR__ . '/auth.php';
