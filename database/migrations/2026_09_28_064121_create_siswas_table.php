<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            // Relasi ke users
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Relasi data sekolah
            $table->foreignId('sekolah_id')
                ->constrained('sekolahs')
                ->restrictOnDelete();

            // Relasi jurusan
            $table->foreignId('jurusan_id')
                ->constrained('jurusans')
                ->restrictOnDelete();

            // Relasi kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->restrictOnDelete();

            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('no_telepon');

            $table->string('tempat_pkl');
            $table->date('tanggal_mulai_pkl');
            $table->date('tanggal_selesai_pkl');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
