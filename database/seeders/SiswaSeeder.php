<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Siswa $i",
                'email' => "siswa$i@spada.test",
                'password' => bcrypt('password'),
                'role_id' => 3,
            ]);

            Siswa::create([
                'user_id' => $user->id,
                'nis' => "202400$i",
                'nama' => $user->name,
            ]);
        }
    }
}
