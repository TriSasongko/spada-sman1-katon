<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'guru_id',
        'jurusan_id',
    ];

    // Relasi: Kelas -> Banyak Siswa (One-to-Many)
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    // Relasi: Kelas -> Guru (Many-to-One)
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Relasi: Kelas -> Jurusan (Many-to-One)
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
