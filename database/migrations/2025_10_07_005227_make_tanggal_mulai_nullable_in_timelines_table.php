<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan perubahan migrasi.
     */
    public function up(): void
    {
        Schema::table('timelines', function (Blueprint $table) {
            // Ubah kolom tanggal_mulai menjadi nullable
            $table->dateTime('tanggal_mulai')->nullable()->change();
        });
    }

    /**
     * Kembalikan perubahan migrasi.
     */
    public function down(): void
    {
        Schema::table('timelines', function (Blueprint $table) {
            // Kembalikan ke kondisi semula (tidak nullable)
            $table->dateTime('tanggal_mulai')->nullable(false)->change();
        });
    }
};
