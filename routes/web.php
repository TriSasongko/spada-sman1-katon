<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruDashboardController; // <-- Tambahkan
use App\Http\Controllers\SiswaDashboardController; // <-- Tambahkan

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard Default (Mungkin hanya diakses jika tidak ada role spesifik)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute yang Membutuhkan Otentikasi
Route::middleware('auth')->group(function () {

    // Rute Profile Standar
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------------------------------------------------------
    // Rute Dashboard Multi-Role (BARU)
    // ------------------------------------------------------------------

    // Rute Dashboard Guru
    Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
        ->name('guru.dashboard');

    // Rute Dashboard Siswa
    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])
        ->name('siswa.dashboard');

    // Catatan: Rute Admin (Filament) ditangani secara otomatis oleh Filament
});

require __DIR__.'/auth.php';
