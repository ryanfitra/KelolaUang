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
            $table->string('title');              // Judul kegiatan
            $table->text('description')->nullable(); // Deskripsi kegiatan
            $table->dateTime('start_date');           // Tanggal mulai
            $table->dateTime('end_date')->nullable(); // Tanggal selesai (opsional)
            $table->timestamps();
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
