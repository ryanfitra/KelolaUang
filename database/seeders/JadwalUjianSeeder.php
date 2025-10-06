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
                'sesi' => '1',
                'waktu_mulai_to' => '2025-10-06 10:00:00',
                'waktu_selesai_to' => '2025-10-06 10:30:00',
                'waktu_mulai_ujian' => '2025-10-06 10:00:00',
                'waktu_selesai_ujian' => '2025-10-06 11:00:00',
                'waktu_pengumuman' => '2025-10-06 15:00:00'                    
            ],
            [
                'jenis_ujian_id' => '2',
                'sesi' => '1',
                'waktu_mulai_to' => '2025-10-08 10:00:00',
                'waktu_selesai_to' => '2025-10-08 10:30:00',
                'waktu_mulai_ujian' => '2025-10-11 10:00:00',
                'waktu_selesai_ujian' => '2025-10-11 11:00:00',
                'waktu_pengumuman' => '2025-10-30 15:00:00',                    
            ],
            [
                'jenis_ujian_id' => '2',
                'sesi' => '2',
                'waktu_mulai_to' => '2025-10-08 10:00:00',
                'waktu_selesai_to' => '2025-10-08 10:30:00',
                'waktu_mulai_ujian' => '2025-10-11 10:00:00',
                'waktu_selesai_ujian' => '2025-10-11 11:00:00',
                'waktu_pengumuman' => '2025-10-30 15:00:00',                      
            ],
            [
                'jenis_ujian_id' => '2',
                'sesi' => '3',
                'waktu_mulai_to' => '2025-10-08 10:00:00',
                'waktu_selesai_to' => '2025-10-08 10:30:00',
                'waktu_mulai_ujian' => '2025-10-11 10:00:00',
                'waktu_selesai_ujian' => '2025-10-11 11:00:00',
                'waktu_pengumuman' => '2025-10-30 15:00:00',                      
            ],
        ];

        foreach ($data as $d) {
            JadwalUjian::create($d);
        }
    }
}
