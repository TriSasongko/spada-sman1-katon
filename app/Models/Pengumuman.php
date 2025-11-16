<?php

namespace App\Models;

use App\Events\PengumumanCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'file_path',
        'target',
        'target_ids',
        'published_at',
        'kirim_notifikasi',
        'kelas_id', // opsional jika kamu simpan single kelas
        'user_id', // pembuat
        'tampilkan',
    ];

    protected $table = 'pengumumans';

    protected $casts = [
        'target_ids' => 'array',
        'published_at' => 'datetime',
        'kirim_notifikasi' => 'boolean',
    ];

    // dispatch event setelah dibuat
    protected static function booted()
    {
        static::created(function (Pengumuman $pengumuman) {
            if ($pengumuman->kirim_notifikasi && $pengumuman->published_at === null) {
                // segera dispatch event
                PengumumanCreated::dispatch($pengumuman);
            } elseif ($pengumuman->kirim_notifikasi && $pengumuman->published_at) {
                // jika ada published_at di masa depan, schedule via job / dispatch delay
                $delayUntil = $pengumuman->published_at;
                PengumumanCreated::dispatch($pengumuman)->delay($delayUntil);
            }
        });
    }

    // pembuat (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
