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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('posisi_id')->after('ijazah')->nullable();

            // Jika ingin langsung bikin relasi foreign key
            $table->foreign('posisi_id')
                  ->references('id')
                  ->on('jabatans') // karena sebelumnya tabel posisi diganti jadi jabatans
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['posisi_id']);
            $table->dropColumn('posisi_id');
        });
    }
};
