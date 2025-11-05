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
        Schema::table('jadwal_ujians', function (Blueprint $table) {
            $table->dateTime('waktu_mulai_to')->nullable()->change();
            $table->dateTime('waktu_selesai_to')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ujians', function (Blueprint $table) {
            $table->dateTime('waktu_mulai_to')->nullable(false)->change();
            $table->dateTime('waktu_selesai_to')->nullable(false)->change();
        });
    }
};
