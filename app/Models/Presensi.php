<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = [
        'pertemuan_id',
        'siswa_id',
        'status',
        'metode',
    ];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
