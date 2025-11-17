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
}
