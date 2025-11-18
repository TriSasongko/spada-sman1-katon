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
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    // Role check
    public function isAdmin(): bool
    {
        return $this->role_id === 1 || optional($this->role)->name === 'Admin';
    }

    public function isGuru(): bool
    {
        return $this->role_id === 2 || optional($this->role)->name === 'Guru';
    }

    public function isSiswa(): bool
    {
        return $this->role_id === 3 || optional($this->role)->name === 'Siswa';
    }

    // Filament access
    public function canAccessFilament(): bool
    {
        return $this->isAdmin(); // atau tambah isGuru() jika Guru juga boleh akses Filament
    }
}
