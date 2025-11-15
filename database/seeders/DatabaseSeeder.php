<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
            KelasSeeder::class,
            SampleContentSeeder::class,
        ]);
    }
}
