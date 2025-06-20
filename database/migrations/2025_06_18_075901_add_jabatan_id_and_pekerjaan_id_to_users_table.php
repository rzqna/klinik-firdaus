<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom jabatan_id sebagai foreign key
            $table->foreignId('jabatan_id')
                  ->nullable()
                  ->constrained('jabatans')
                  ->onDelete('set null')
                  ->after('email'); // Sesuaikan posisi

            // Tambahkan kolom pekerjaan_id sebagai foreign key
            $table->foreignId('pekerjaan_id')
                  ->nullable()
                  ->constrained('pekerjaans')
                  ->onDelete('set null')
                  ->after('jabatan_id'); // Sesuaikan posisi

            // Pastikan kolom NIK juga diubah jika belum (dari pembahasan sebelumnya)
            // Hapus atau komen baris ini jika NIK sudah VARCHAR/STRING yang benar
            // $table->string('nik', 20)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu sebelum menghapus kolom
            $table->dropConstrainedForeignId('pekerjaan_id'); // Hapus pekerjaan_id dulu karena after(jabatan_id)
            $table->dropConstrainedForeignId('jabatan_id');

            // Jika Anda juga mengubah NIK di up(), Anda bisa mengembalikan di sini,
            // tetapi biasanya tidak perlu jika sudah settle.
            // $table->integer('nik')->change();
        });
    }
};
