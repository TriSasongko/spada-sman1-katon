<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Pastikan kolom ini ada di tabel users
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: User -> Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi: User -> Guru
    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    // Relasi: User -> Siswa (One-to-One)
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    // --- Method Pengecekan Peran (Role Check Methods) ---

    public function isAdmin(): bool
    {
        // Menggunakan ID 1 untuk Admin (sesuai RoleSeeder Anda)
        return $this->role_id === 1 || $this->role->name === 'Admin';
    }

    public function isGuru(): bool
    {
        // Menggunakan ID 2 untuk Guru (sesuai RoleSeeder Anda)
        return $this->role_id === 2 || $this->role->name === 'Guru';
    }

    public function isSiswa(): bool
    {
        // Menggunakan ID 3 untuk Siswa (sesuai RoleSeeder Anda)
        return $this->role_id === 3 || $this->role->name === 'Siswa';
    }

    // --- Method Wajib untuk Filament ---

    public function canAccessFilament(): bool
    {
        // Hanya Admin yang diizinkan mengakses dashboard Filament
        return $this->isAdmin();
    }
}
