<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Informasi perusahaan/tempat PKL dan titik koordinat lokasi PKL.
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telepon')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedInteger('radius_absensi')->default(100);
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        // Kolom profil tambahan pada tabel yang sudah ada.
        Schema::table('gurus', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto_profil')->nullable();
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->text('alamat')->nullable();
            $table->string('foto_profil')->nullable();

            // Perusahaan tempat siswa menjalani PKL bersifat opsional.
            $table->foreignId('perusahaan_id')
                ->nullable()
                ->after('kelas_id')
                ->constrained('perusahaans')
                ->nullOnDelete();
        });

        Schema::table('sekolahs', function (Blueprint $table) {
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
        });

        Schema::table('absensis', function (Blueprint $table) {
            // Koordinat yang direkam saat siswa melakukan absensi.
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });

        Schema::table('sekolahs', function (Blueprint $table) {
            $table->dropColumn(['no_telepon', 'email', 'logo']);
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['perusahaan_id']);
            $table->dropColumn(['alamat', 'foto_profil', 'perusahaan_id']);
        });

        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'alamat', 'foto_profil']);
        });

        Schema::dropIfExists('perusahaans');
    }
};
