<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama',
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswa');
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}
