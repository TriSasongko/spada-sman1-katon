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

// ROOT
// Kalau belum login → ke login
// Kalau sudah login → redirect ke dashboard sesuai role
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('redirect.role');
    }
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

// REDIRECT ROLE (pengganti /home)
Route::get('/redirect-role', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect('/admin'),
        'guru' => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => abort(403, 'Role tidak valid'),
    };
})->name('redirect.role')->middleware('auth');

// ROUTES YANG BUTUH LOGIN
Route::middleware('auth')->group(function () {

    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])
        ->name('siswa.dashboard');

    Route::get('/guru', [GuruDashboardController::class, 'index'])
        ->name('guru.dashboard');

    // ❌ HAPUS route /home karena tidak dipakai dan bikin ke sana terus
});

// LOGOUT
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// LOGOUT FILAMENT
Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('filament.admin.auth.logout');

// AUTH LAIN
require __DIR__ . '/auth.php';
