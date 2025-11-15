<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Pengumuman;
use App\Models\ForumTopic;

class SampleContentSeeder extends Seeder
{
    public function run(): void
    {
        Materi::create([
            'judul' => 'Pengantar Biologi',
            'deskripsi' => 'Materi dasar mengenai pengantar biologi.',
            'kelas_id' => 1,
            'guru_id' => 1,
            'file_path' => null,
            'published_at' => now(),
        ]);

        Pengumuman::create([
            'judul' => 'Pertemuan Minggu Ini',
            'isi' => 'Pertemuan akan dilakukan di ruang kelas utama.',
            'user_id' => 1,
            'kelas_id' => 1,
            'published_at' => now(),
        ]);

        ForumTopic::create([
            'judul' => 'Diskusi Bab 1',
            'isi' => 'Silakan diskusi mengenai materi Bab 1.',
            'user_id' => 2,
            'kelas_id' => 1,
        ]);
    }
}
