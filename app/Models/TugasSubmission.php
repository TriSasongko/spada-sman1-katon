<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TugasSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file',
        'nilai',
        'catatan',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
