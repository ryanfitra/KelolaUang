<?php

namespace Database\Seeders;

use App\Models\PesertaUjian;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PesertaUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => '2',
                'no_peserta' => '025-10-123456',
                'jenis_ujian_id' => '1',
                'status_ujian' => NULL,
                // 'tanggal_daftar' => '2025-08-20'
            ],
            // [
            //     'user_id' => '2',
            //     'no_peserta' => '025-10-123456',
            //     'jenis_ujian_id' => '2',
            //     'status_ujian' => NULL,
            //     // 'tanggal_daftar' => '2025-08-20'
            // ],
        ];

        foreach ($data as $d) {
            PesertaUjian::create($d);
        }
    }
}
