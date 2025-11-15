<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@spada.test',
            'password' => bcrypt('password'),
            'role_id' => 1, // Admin
        ]);
    }
}
