<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peserta_ujians', function (Blueprint $table) {

            $table->unsignedBigInteger('id_jabatan_lulus')
                  ->nullable()
                  ->after('status_ujian');

            $table->foreign('id_jabatan_lulus')
                  ->references('id')
                  ->on('jabatans')
                  ->nullOnDelete(); // jika jabatan dihapus, kolom jadi NULL
        });
    }

    public function down(): void
    {
        Schema::table('peserta_ujians', function (Blueprint $table) {

            $table->dropForeign(['id_jabatan_lulus']);
            $table->dropColumn('id_jabatan_lulus');
        });
    }
};