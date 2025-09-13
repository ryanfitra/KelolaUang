<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // kolom tambahan
            $table->string('nik')->nullable()->after('nama');
            $table->enum('warga_negara', ['WNI', 'WNA'])->nullable()->after('nik');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('warga_negara');
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->text('alamat')->nullable()->after('tanggal_lahir');
            $table->string('alamat_kelurahan_desa')->nullable()->after('alamat');
            $table->string('kode_kelurahan_desa')->nullable()->after('alamat_kelurahan_desa');
            $table->string('alamat_kecamatan')->nullable()->after('kode_kelurahan_desa');
            $table->string('kode_kecamatan')->nullable()->after('alamat_kecamatan');
            $table->string('alamat_kabupaten_kota')->nullable()->after('kode_kecamatan');
            $table->string('kode_kabupaten_kota')->nullable()->after('alamat_kabupaten_kota');
            $table->string('alamat_provinsi')->nullable()->after('kode_kabupaten_kota');
            $table->string('kode_provinsi')->nullable()->after('alamat_provinsi');
            $table->string('agama')->nullable()->after('kode_provinsi');
            $table->string('no_wa')->nullable()->after('agama');
            $table->string('wa_sender')->nullable()->after('no_wa');
            $table->string('foto')->nullable()->after('wa_sender');
            $table->enum('pendidikan_terakhir', ['SMA/SMK/Sederajat', 'Diploma III', 'Diploma IV', 'Strata 1', 'Strata 2', 'Strata 3'])->nullable()->after('foto');
            $table->string('jurusan')->nullable()->after('pendidikan_terakhir');
            $table->string('sekolah_universitas')->nullable()->after('jurusan');
            // $table->decimal('rata_nilai_ipk', 4, 2)->nullable()->after('sekolah_universitas');
            $table->string('ijazah')->nullable()->after('sekolah_universitas');
            $table->string('posisi')->nullable()->after('ijazah');
            // $table->longText('pengalaman_kerja')->nullable()->after('posisi');
            $table->unsignedBigInteger('instansi_id')->after('posisi');
            $table->date('tanggal_daftar')->after('instansi_id');
            // $table->string('sumber_info')->nullable()->after('tanggal_daftar');
            
            // kolom foreign
            $table->foreign('instansi_id')->references('id')->on('daftar_instansis')->onDelete('cascade');


            // kolom role
            $table->enum('role', ['admin', 'peserta'])->default('peserta')->after('password');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // rollback: balikin ke awal
            $table->dropColumn([
                'nik',
                'warga_negara',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'alamat',
                'alamat_provinsi',
                'alamat_kabupaten',
                'alamat_kecamatan',
                'agama',
                'no_wa',
                'wa_sender',
                'nama_foto',
                'pendidikan_terakhir',
                'ijazah',
                'role',
                'posisi',
                'tanggal_daftar'
            ]);
        });
    }
};
