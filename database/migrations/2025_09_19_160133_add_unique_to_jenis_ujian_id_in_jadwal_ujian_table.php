<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_ujians', function (Blueprint $table) {
            $table->unique('jenis_ujian_id', 'jadwal_ujian_jenis_unique');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_ujians', function (Blueprint $table) {
            $table->dropUnique('jadwal_ujian_jenis_unique');
        });
    }
};
