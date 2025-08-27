<?php

namespace Database\Seeders;

use App\Models\DaftarInstansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaftarInstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_instansi' => 'Universitas Sriwijaya',
                'alamat' => 'Jalan Palembang-Prabumulih, KM 32 Inderalaya,Kabupaten Ogan Ilir, Sumater Selatan',
                'telepon' => '(+62) 0711-580739',
                'email' => 'humas@unsri.ac.id',
            ],
            [
                'nama_instansi' => 'PT Tanjungenim Lestari Pulp and Paper ( TELPP)',
                'alamat' => 'Kab. Muara Enim, Sumatera Selatan',
                'telepon' => '(+62) 713-324-150',
                'email' => 'marketing@telpp.com',
            ],
            
        ];

        foreach ($data as $d) {
            DaftarInstansi::create($d);
        }
    }
}
