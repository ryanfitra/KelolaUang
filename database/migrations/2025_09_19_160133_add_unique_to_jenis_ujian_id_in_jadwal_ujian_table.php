<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_ujians', function (Blueprint $table) {
            $table->string('sesi')->after('jenis_ujian_id')->nullable();
            $table->unique(['jenis_ujian_id', 'sesi'], 'jenis_ujian_sesi_unique');
            // $table->unique('jenis_ujian_id', 'jadwal_ujian_jenis_unique');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_ujians', function (Blueprint $table) {
            $table->dropColumn('sesi');
            $table->dropUnique('jenis_ujian_sesi_unique');
        });
    }
};
