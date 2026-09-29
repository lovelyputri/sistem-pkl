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
            'alamat' => 'Jl. KH. Hasyim Asyari No.38, Pancoran Kulon, Rogojampi, Kec. Rogojampi, Kabupaten Banyuwangi, Jawa Timur 68462',
        ]);
    }
}