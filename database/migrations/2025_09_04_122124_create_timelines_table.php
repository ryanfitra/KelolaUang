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
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instansi_id');
            $table->string('nama_kegiatan');              // Judul kegiatan
            $table->text('deskripsi')->nullable(); // Deskripsi kegiatan
            $table->dateTime('tanggal_mulai');           // Tanggal mulai
            $table->dateTime('tanggal_selesai')->nullable(); // Tanggal selesai (opsional)
            $table->timestamps();

            // kolom foreign
            $table->foreign('instansi_id')->references('id')->on('daftar_instansis')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
