<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_wawancara_darings', function (Blueprint $table) {
            $table->id();

            // Nomor Peserta
            $table->string('nomor_peserta');

            // Relasi ke jadwal ujian
            $table->unsignedBigInteger('jadwal_ujian_id');
            $table->foreign('jadwal_ujian_id')
                ->references('id')
                ->on('jadwal_ujians')
                ->onDelete('cascade');

            // Waktu mulai & selesai wawancara
            $table->dateTime('waktu_mulai_wawancara')->nullable();
            $table->dateTime('waktu_selesai_wawancara')->nullable();

            // Link wawancara (boleh kosong)
            $table->string('link_wawancara')->nullable();

            $table->timestamps();

            // Jika 1 peserta tidak boleh punya jadwal wawancara ganda di jadwal ujian yang sama
            $table->unique(['nomor_peserta', 'jadwal_ujian_id'], 'uniq_nomorpeserta_jadwal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_peserta_wawancara_darings');
    }
};
