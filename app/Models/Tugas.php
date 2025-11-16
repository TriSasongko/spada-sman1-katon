<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'guru_id',
        'judul',
        'deskripsi',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function submissions()
    {
        return $this->hasMany(TugasSubmission::class);
    }
}
