<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Jurusan;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $guru = Guru::first();
        $jurusan = Jurusan::first();

        if (!$guru || !$jurusan) return;

        $kelas = Kelas::firstOrCreate(
            ['nama' => 'X IPA 1'],
            [
                'guru_id' => $guru->id,
                'jurusan_id' => $jurusan->id, // WAJIB
            ]
        );

        $siswas = Siswa::all()->take(10);

        foreach ($siswas as $siswa) {
            $kelas->siswas()->syncWithoutDetaching([$siswa->id]);
        }
    }
}
