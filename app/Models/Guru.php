<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'nip',
        'jenis_kelamin',
        'telepon',
        'email',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relasi one-to-many: Guru sebagai Wali Kelas untuk banyak Kelas
     */
    public function kelasWali(): HasMany
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }

    /**
     * Relasi many-to-many: Guru mengajar banyak Kelas
     */
    public function kelasDiajar(): BelongsToMany
    {
        return $this->belongsToMany(Kelas::class, 'guru_kelas', 'guru_id', 'kelas_id')
            ->withTimestamps();
    }

    /**
     * Relasi many-to-many dengan Mapel
     */
    public function mapels(): BelongsToMany
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel', 'guru_id', 'mapel_id')
            ->withTimestamps();
    }

    /**
     * Accessor untuk mendapatkan nama jenis kelamin
     */
    public function getJenisKelaminLabelAttribute(): string
    {
        return match ($this->jenis_kelamin) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => 'Tidak Diketahui'
        };
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
