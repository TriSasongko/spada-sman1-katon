<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'kelas_id',
        'user_id',
        'foto',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    // Relasi: Siswa -> Kelas (Many-to-One)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi: Siswa -> User (One-to-One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
