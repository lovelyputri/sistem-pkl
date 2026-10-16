<?php
namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    public function run(): void
    {
        Sekolah::updateOrCreate(
            [
                'nama_sekolah' => 'SMK Muhammadiyah 6 Rogojampi',
            ],
            [
                'alamat' => 'Jl. KH. Hasyim Asyari No.38, Pancoran Kulon, Rogojampi, Kec. Rogojampi, Kabupaten Banyuwangi, Jawa Timur 68462',

                // Ganti dengan nomor telepon resmi sekolah
                'no_telepon' => '0333631234',

                // Ganti dengan email resmi sekolah
                'email' => 'smkmuhammadiyah6rogojampi@gmail.com',

                // Path relatif terhadap storage/app/public
                'logo' => 'logos/sekolah/logo-smkm6.png',
            ]
        );
    }
}
