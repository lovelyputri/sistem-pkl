<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::insert([
            [
                'nama_kelas' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => '11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => '12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}