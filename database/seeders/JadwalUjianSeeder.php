<?php

namespace Database\Seeders;

use App\Models\JadwalUjian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'jenis_ujian_id' => '1',
                'waktu_mulai_to' => '2025-08-25 08:00:00',
                'waktu_selesai_to' => '2025-08-25 09:00:00',
                'waktu_mulai_ujian' => '2025-08-26 08:00:00',
                'waktu_selesai_ujian' => '2025-08-26 12:00:00',
            ],
            [
                'jenis_ujian_id' => '2',
                'waktu_mulai_to' => '2025-09-25 08:00:00',
                'waktu_selesai_to' => '2025-09-25 09:00:00',
                'waktu_mulai_ujian' => '2025-09-28 08:00:00',
                'waktu_selesai_ujian' => '2025-09-28 09:00:00',
            ],
        ];

        foreach ($data as $d) {
            JadwalUjian::create($d);
        }
    }
}
