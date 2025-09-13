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
        Schema::create('jadwal_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_ujian_id'); // reference to jenis_ujian
            // $table->unsignedBigInteger('paket_ujian')->nullable(); // paket ujian, optional
            $table->dateTime('waktu_mulai_to');
            $table->dateTime('waktu_selesai_to');
            $table->dateTime('waktu_mulai_ujian');
            $table->dateTime('waktu_selesai_ujian');
            $table->dateTime('waktu_pengumuman');
            $table->timestamps();            

            $table->foreign('jenis_ujian_id')->references('id')->on('jenis_ujians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujians');
    }
};
