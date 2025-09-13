<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Admin PT TEL',
                'email' => 'admin_pt_tel@local.com',
                'role' => 'admin',
                'password' => bcrypt('pttel2025@!'), // password di-hash
                'instansi_id' => '1',
                'tanggal_daftar'=> '2025-08-01'
            ],
            [
                'nama' => 'Peserta CBT',
                'email' => 'peserta_cbt@unsri.ac.id',
                'role' => 'peserta',
                'password' => bcrypt('Eleunsri*#*#'), // password di-hash
                'nik' => '1234567890123456',
                'warga_negara' => 'WNI',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '2000-01-01',
                'alamat' => 'Jl. Gandus',
                'alamat_kelurahan_desa' => 'Kel. Gandus',
                'kode_kelurahan_desa' => '116071',
                'alamat_kecamatan' => 'Kec. Gandus',
                'kode_kecamatan' => '116012',
                'alamat_kabupaten_kota' => 'Kota Palembang ',
                'kode_kabupaten_kota' => '116000',
                'alamat_provinsi' => 'Prov. Sumatera Selatan',
                'kode_provinsi' => '110000',
                'agama' => 'Islam',
                'no_wa' => '081234567890',
                'wa_sender' => '7890',
                'foto' => 'peserta1.jpg',
                'pendidikan_terakhir' => 'Strata 1',
                'jurusan' => 'Sistem Komputer',
                'sekolah_universitas' => 'Universitas Sriwijaya',
                // 'rata_nilai_ipk' => '3.08',
                'ijazah' => 'ijazah_peserta1.pdf',
                'posisi' => 'Programmer',
                // 'pengalaman_kerja'=> '1. Finance Officer, PT Cahaya Riau Mandiri,2024 - Sekarang 
                //                         2. Admin Claim, PT Jamkrindo Cabang Palembang, 2024 - 2024
                //                         3. Staf Keuangan dan Anggaran, Dinas Perhubungan Kabupaten Ogan Ilir, 2021 - 2024',
                'instansi_id' => '2',
                'tanggal_daftar' => '2025-08-01',
            ],
        ];

        foreach ($data as $d) {
            User::create($d);
        }
    }
}
