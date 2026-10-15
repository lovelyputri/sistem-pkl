<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Membuat satu akun siswa khusus untuk pengujian.
     */
    public function run(): void
    {
        $sekolah = Sekolah::firstOrCreate(
            ['nama_sekolah' => 'SMK Muhammadiyah 6 Rogojampi'],
            ['alamat' => 'Rogojampi, Banyuwangi, Jawa Timur']
        );

        $jurusan = Jurusan::firstOrCreate([
            'nama_jurusan' => 'Rekayasa Perangkat Lunak',
        ]);

        $kelas = Kelas::firstOrCreate([
            'nama_kelas' => '12',
        ]);

        $user = User::updateOrCreate(
            ['email' => 'siswa@gmail.com'],
            [
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status' => 'approved',
            ]
        );

        Siswa::updateOrCreate(
            ['user_id' => $user->id],
            [
                'sekolah_id' => $sekolah->id,
                'jurusan_id' => $jurusan->id,
                'kelas_id' => $kelas->id,
                'nama_lengkap' => 'Siswa Uji Coba',
                'tempat_lahir' => 'Banyuwangi',
                'nisn' => '0098765432',
                'tanggal_lahir' => '2008-01-01',
                'jenis_kelamin' => 'Perempuan',
                'no_telepon' => '081234567890',
                'guru_id' => null,
                'tanggal_mulai_pkl' => null,
                'tanggal_selesai_pkl' => null,
            ]
        );
    }
}
