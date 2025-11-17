<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'guru_id', // This will now represent the Wali Kelas (Homeroom Teacher)
        'jurusan_id',
    ];

    // Relasi: Kelas -> Banyak Siswa (One-to-Many)
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    // Relasi: Kelas -> Wali Kelas (Many-to-One)
    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi: Kelas -> Banyak Guru yang Mengajar (Many-to-Many)
    public function gurusDiajar(): BelongsToMany
    {
        return $this->belongsToMany(Guru::class, 'guru_kelas', 'kelas_id', 'guru_id')
            ->withTimestamps();
    }

    // Relasi: Kelas -> Jurusan (Many-to-One)
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function guru()
    {
        return $this->belongsTo(\App\Models\Guru::class);
    }

}
