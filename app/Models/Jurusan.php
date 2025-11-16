<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['nama'];

    public function kelases()
    {
        return $this->hasMany(Kelas::class);
    }
}
