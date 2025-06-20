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
        Schema::create('penilaian_karyawan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subkriteria_id')->constrained('subkriterias')->onDelete('cascade');
            $table->integer('nilai_karyawan'); // Nilai yang diberikan untuk karyawan pada subkriteria ini
            $table->timestamps();

            // Pastikan kombinasi user_id dan subkriteria_id unik
            $table->unique(['user_id', 'subkriteria_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_karyawan');
    }
};
