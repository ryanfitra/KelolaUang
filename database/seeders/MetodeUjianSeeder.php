<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodeUjianSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('metode_ujians')->insert([
            ['nama_metode' => 'CAT', 'deskripsi' => 'Computer Assisted Test'],
            ['nama_metode' => 'Wawancara Daring', 'deskripsi' => 'Dilakukan melalui video conference'],
            ['nama_metode' => 'Wawancara Tatap Muka', 'deskripsi' => 'Dilakukan secara langsung di lokasi ujian'],
        ]);
    }
}
