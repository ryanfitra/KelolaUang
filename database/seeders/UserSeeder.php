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
                'nama' => 'Admin CBT',
                'email' => 'admin_cbt@unsri.ac.id',
                'role' => 'admin',
                'password' => bcrypt('Eleunsri*#*#'), // password di-hash
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
                'alamat_provinsi' => 'Prop. Sumatera Selatan',
                'kode_provinsi' => '110000',
                'alamat_kabupaten' => 'Kota Palembang ',
                'kode_kabupaten' => '116000',
                'alamat_kecamatan' => 'Kec. Gandus',
                'kode_kecamatan' => '116012',
                'agama' => 'Islam',
                'no_wa' => '081234567890',
                'wa_sender' => '081234567890',
                'foto' => 'peserta1.jpg',
                'pendidikan_terakhir' => 'SMA',
                'ijazah' => 'ijazah_peserta1.pdf',
                'posisi' => 'Programmer',
                'instansi_id' => '2',
                'tanggal_daftar' => '2025-08-01',
            ],
        ];

        foreach ($data as $d) {
            User::create($d);
        }
    }
}
