<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'guru_id',
        'jurusan_id',
    ];

    protected $withCount = ['siswas'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class);
    }
}
