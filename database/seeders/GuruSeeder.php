<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'guru@spada.test'],
            [
                'name' => 'Guru Contoh',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ]
        );

        Guru::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nip' => '1987654321',
                'nama' => $user->name,
            ]
        );
    }
}
