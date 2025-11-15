<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Siswa;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $guru = Guru::first();

        $kelas = Kelas::create([
            'nama' => 'X IPA 1',
            'guru_id' => $guru->id,
        ]);

        $siswas = Siswa::all()->take(10);

        foreach ($siswas as $siswa) {
            $kelas->siswas()->attach($siswa->id);
        }
    }
}
