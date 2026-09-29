<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    public function run(): void
    {
        Sekolah::create([
            'nama_sekolah' => 'SMK Muhammadiyah 6 Rogojampi',
            'alamat' => null,
        ]);
    }
}
