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
        Schema::table('subkriterias', function (Blueprint $table) {
            // Tambahkan kolom boolean is_core_factor, default true
            $table->boolean('is_core_factor')->default(true)->after('nilai_ideal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subkriterias', function (Blueprint $table) {
            $table->dropColumn('is_core_factor');
        });
    }
};
