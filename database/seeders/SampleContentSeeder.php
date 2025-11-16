<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Materi;
use App\Models\Pengumuman;
use App\Models\ForumTopic;

class SampleContentSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::first();
        $guru = Guru::first();

        if (!$kelas || !$guru) return;

        Materi::create([
            'judul' => 'Pengantar Biologi',
            'deskripsi' => 'Materi dasar mengenai pengantar biologi.',
            'kelas_id' => $kelas->id,
            'guru_id' => $guru->id,
            'file_path' => null,
            'published_at' => now(),
        ]);

        Pengumuman::create([
            'judul' => 'Pertemuan Minggu Ini',
            'isi' => 'Pertemuan akan dilakukan di ruang kelas utama.',
            'user_id' => $guru->user_id,
            'kelas_id' => $kelas->id,
            'published_at' => now(),
        ]);

        ForumTopic::create([
            'judul' => 'Diskusi Bab 1',
            'isi' => 'Silakan diskusi mengenai materi Bab 1.',
            'user_id' => $guru->user_id,
            'kelas_id' => $kelas->id,
        ]);
    }
}
