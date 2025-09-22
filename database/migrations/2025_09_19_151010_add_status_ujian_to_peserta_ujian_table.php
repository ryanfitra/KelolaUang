<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peserta_ujians', function (Blueprint $table) {
            // Ubah kolom status_ujian menjadi ENUM
            DB::statement("ALTER TABLE peserta_ujians 
                MODIFY status_ujian ENUM('Belum Ujian', 'Sedang Ujian', 'Lulus', 'Tidak Lulus') 
                DEFAULT 'Belum Ujian'");
        });
    }

    public function down(): void
    {
        Schema::table('peserta_ujians', function (Blueprint $table) {
            // Rollback ke tipe VARCHAR (atau sesuaikan kondisi sebelumnya)
            DB::statement("ALTER TABLE peserta_ujians 
                MODIFY status_ujian VARCHAR(50) NULL");
        });
    }
};
