<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'instansi_id' =>'2',
                'nama_kegiatan' => 'Tes Tahap I',
                'deskripsi' => 'Verifikasi Data Peserta',
                'tanggal_mulai' => '2025-09-13 08:00:00',
                'tanggal_selesai' => '2025-09-22 15:00:00',

                // 'tanggal_daftar' => '2025-08-20'
            ],
        ];

        foreach ($data as $d) {
            TimeLine::create($d);
        }
    }
}
