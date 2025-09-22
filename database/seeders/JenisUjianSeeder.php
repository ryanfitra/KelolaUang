<?php

namespace Database\Seeders;

use App\Models\JenisUjian;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_ujian' => 'Tes Tahap I',
                'deskripsi' => 'Verifikasi Peserta Online',
            ],
            [
                'nama_ujian' => 'Tes Tahap II',
                'deskripsi' => 'Ujian Tes Potensi Akademik',
            ],
            [
                'nama_ujian' => 'Tes Tahap III',
                'deskripsi' => 'Ujian Psikologi Test (TIKI, Kreaplin, Papikostik, Quisioner)',
            ],
        ];

        foreach ($data as $d) {
            JenisUjian::create($d);
        }
    }
}
