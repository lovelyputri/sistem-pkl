<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->string('status', 20)->default('Hadir')->change();
        });
    }

    public function down(): void
    {
        // Status Terlambat dikembalikan menjadi Hadir agar data tidak hilang
        // ketika migrasi ini dibatalkan.
        Schema::table('absensis', function (Blueprint $table) {
            $table->string('status', 20)->default('Hadir')->change();
        });
        \Illuminate\Support\Facades\DB::table('absensis')
            ->where('status', 'Terlambat')
            ->update(['status' => 'Hadir']);
    }
};
