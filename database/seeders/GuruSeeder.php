<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Guru Contoh',
            'email' => 'guru@spada.test',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        Guru::create([
            'user_id' => $user->id,
            'nip' => '1987654321',
            'nama' => $user->name,
        ]);
    }
}
