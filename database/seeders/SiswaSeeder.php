<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $user = User::firstOrCreate(
                ['email' => "siswa$i@spada.test"],
                [
                    'name' => "Siswa $i",
                    'password' => Hash::make('password'),
                    'role_id' => 3,
                ]
            );

            Siswa::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nis' => "202400$i",
                    'nama' => $user->name,
                ]
            );
        }
    }
}
