<?php

namespace App\Helpers\Siswa;

use App\Helpers\PaginateHelper;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JurnalHelper
{
    public static function getDataIndex(Request $request): array
    {
        $siswa = Siswa::where('user_id', auth()->id())->firstOrFail();
        $query = Jurnal::where('siswa_id', $siswa->id);
        $cari = trim($request->string('cari')->toString());
        if ($cari !== '') {
            $query->where(function ($builder) use ($cari) {
                $builder->where('judul', 'like', "%{$cari}%")
                    ->orWhere('kegiatan', 'like', "%{$cari}%");
            });
        }
        if ($request->filled('tanggal')) {
            $tanggal = $request->date('tanggal');
            if ($tanggal) $query->whereDate('tanggal', $tanggal);
        }
        return [
            'siswa' => $siswa,
            'jurnals' => PaginateHelper::paginate($query->latest('tanggal')->latest('id'), 10),
            'jurnalHariIni' => Jurnal::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->first(),
            'totalJurnal' => Jurnal::where('siswa_id', $siswa->id)->count(),
            'cari' => $cari,
        ];
    }
}
