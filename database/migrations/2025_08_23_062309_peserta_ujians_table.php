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
        Schema::create('peserta_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('no_peserta');
            $table->unsignedBigInteger('jenis_ujian_id'); // reference to jenis_ujian
            $table->string('status_ujian')->nullable();
            $table->timestamps();

            $table->foreign('jenis_ujian_id')->references('id')->on('jenis_ujians')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // 🔑 Unique constraint: no_peserta + jenis_ujian_id
            $table->unique(['no_peserta', 'jenis_ujian_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_ujians');
    }
};
