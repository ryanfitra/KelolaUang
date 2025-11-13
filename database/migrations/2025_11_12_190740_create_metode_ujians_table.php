<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * 1️⃣ Buat tabel metode_ujians
         */
        Schema::create('metode_ujians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_metode');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        /**
         * 2️⃣ Tambahkan kolom metode_ujian_id (JSON) ke tabel jadwal_ujians
         */
        if (Schema::hasTable('jadwal_ujians') && !Schema::hasColumn('jadwal_ujians', 'metode_ujian_id')) {
            Schema::table('jadwal_ujians', function (Blueprint $table) {
                $table->json('metode_ujian_id')->nullable()->after('jenis_ujian_id');
                // JSON digunakan agar bisa menyimpan array ID metode ujian
                // contoh: ["1", "2"] = CAT & Wawancara Daring
            });
        }
    }

    public function down(): void
    {
        /**
         * 3️⃣ Hapus kolom metode_ujian_id dari jadwal_ujians
         */
        if (Schema::hasTable('jadwal_ujians') && Schema::hasColumn('jadwal_ujians', 'metode_ujian_id')) {
            Schema::table('jadwal_ujians', function (Blueprint $table) {
                $table->dropColumn('metode_ujian_id');
            });
        }

        /**
         * 4️⃣ Hapus tabel metode_ujians
         */
        Schema::dropIfExists('metode_ujians');
    }
};
