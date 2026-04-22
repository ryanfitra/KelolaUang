<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('types')->insert([
            [
                'name' => 'Pemasukan',
                'code' => 'income',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengeluaran',
                'code' => 'expense',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}