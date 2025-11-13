<?php

namespace Database\Seeders;

use App\Models\DaftarInstansi;
use App\Models\JenisUjian;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(DaftarInstansiSeeder::class);
        $this->call(JenisUjianSeeder::class);
        $this->call(JadwalUjianSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PesertaUjianSeeder::class);
        $this->call(TimelineSeeder::class);
        $this->call(MetodeUjianSeeder::class);
    }
}
