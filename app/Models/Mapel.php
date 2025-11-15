<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relasi many-to-many dengan Guru
     */
    public function gurus(): BelongsToMany
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel', 'mapel_id', 'guru_id')
            ->withTimestamps();
    }

    /**
     * Accessor untuk mendapatkan nama lengkap mapel dengan kode
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->kode_mapel} - {$this->nama_mapel}";
    }
}
