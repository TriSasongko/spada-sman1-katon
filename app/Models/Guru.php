<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'jenis_kelamin',
        'telepon',
        'email',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function mapels()
    {
        return $this->belongsToMany(Mapel::class);
    }

}
