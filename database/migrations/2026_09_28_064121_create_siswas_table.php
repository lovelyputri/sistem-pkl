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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('user')->cascadeOnDelete();

            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('no_telepon');
            $table->string('nama_sekolah');
            $table->string('jurusan');
            $table->string('kelas');

            $table->string('tempat_pkl');
            $table->date('tanggal_mulai_pkl');
            $table->date('tanggal_selesai_pkl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
