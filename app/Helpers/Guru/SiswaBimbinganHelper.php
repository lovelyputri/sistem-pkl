<?php

namespace App\Helpers\Guru;

use App\Helpers\PaginateHelper;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaBimbinganHelper
{
    public static function getDataIndex(Request $request): array
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();

        $siswaQuery = Siswa::where('guru_id', $guru->id);
        $totalSiswa = (clone $siswaQuery)->count();
        $totalSekolah = (clone $siswaQuery)->whereNotNull('sekolah_id')->distinct()->count('sekolah_id');
        $totalJurusan = (clone $siswaQuery)->whereNotNull('jurusan_id')->distinct()->count('jurusan_id');

        $query = Siswa::with(['sekolah', 'kelas', 'jurusan', 'user'])
            ->where('guru_id', $guru->id);

        $cari = trim($request->string('cari')->toString());

        if ($cari !== '') {
            $query->where(function ($builder) use ($cari) {
                $builder->where('nama_lengkap', 'like', "%{$cari}%")
                    ->orWhere('nisn', 'like', "%{$cari}%");
            });
        }

        return [
            'guru' => $guru,
            'siswas' => PaginateHelper::paginate($query->orderBy('nama_lengkap'), 15),
            'totalSiswa' => $totalSiswa,
            'totalSekolah' => $totalSekolah,
            'totalJurusan' => $totalJurusan,
            'cari' => $cari,
        ];
    }
}
