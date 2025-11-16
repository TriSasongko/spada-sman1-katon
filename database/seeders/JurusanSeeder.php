<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        Jurusan::create([
            'nama' => 'Ilmu Pengetahuan Alam',
            'kode' => 'IPA',
        ]);

        Jurusan::create([
            'nama' => 'Ilmu Pengetahuan Sosial',
            'kode' => 'IPS',
        ]);
    }
}
