<?php

namespace App\Helpers\Admin;

use App\Helpers\PaginateHelper;
use App\Models\Jurusan;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahJurusanHelper
{
    public static function getDataIndex(Request $request): array
    {
        $cariSekolah = trim((string) $request->query('cari_sekolah', ''));
        $cariJurusan = trim((string) $request->query('cari_jurusan', ''));

        $querySekolah = Sekolah::query()
            ->withCount('siswas')
            ->when($cariSekolah !== '', fn ($q) => $q->where('nama_sekolah', 'like', "%{$cariSekolah}%"))
            ->orderBy('nama_sekolah');

        $queryJurusan = Jurusan::query()
            ->withCount('siswas')
            ->when($cariJurusan !== '', fn ($q) => $q->where('nama_jurusan', 'like', "%{$cariJurusan}%"))
            ->orderBy('nama_jurusan');

        return [
            'sekolahs' => PaginateHelper::paginate($querySekolah, 8, 'halaman_sekolah'),
            'jurusans' => PaginateHelper::paginate($queryJurusan, 8, 'halaman_jurusan'),
            'cariSekolah' => $cariSekolah,
            'cariJurusan' => $cariJurusan,
        ];
    }
}
