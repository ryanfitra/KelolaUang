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
            // [
            //     'nama_ujian' => 'Try Out TPA',
            //     'deskripsi' => 'Try Out Ujian Tes Potensi Akademik',
            // ],
            [
                'nama_ujian' => 'Ujian TPA',
                'deskripsi' => 'Ujian Tes Potensi Akademik',
            ],
            // [
            //     'nama_ujian' => 'Try Out Psikotest',
            //     'deskripsi' => 'Try Out Ujian Psikologi Test (TIKI, Kreaplin, Papikostik, Quisioner)',
            // ],
            [
                'nama_ujian' => 'Ujian Psikotest',
                'deskripsi' => 'Ujian Psikologi Test (TIKI, Kreaplin, Papikostik, Quisioner)',
            ],
            
            
        ];

        foreach ($data as $d) {
            JenisUjian::create($d);
        }
    }
}
