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
            // Pastikan kolom sudah ada sebelum ditambahkan unique
            if (Schema::hasColumn('users', 'no_wa')) {
                $table->unique('no_wa');
            }
        });
    }

    /**
     * Kembalikan perubahan jika rollback
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['no_wa']);
        });
    }
};
