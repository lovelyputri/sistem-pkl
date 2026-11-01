<?php

namespace App\Helpers\Guru;

use App\Helpers\PaginateHelper;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JurnalHelper
{
    public static function getDataIndex(Request $request): array
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $siswaIds = Siswa::where('guru_id', $guru->id)->select('id');

        $query = Jurnal::with('siswa')
            ->whereIn('siswa_id', clone $siswaIds);

        $cari = trim($request->string('cari')->toString());
        $tanggal = $request->filled('tanggal') ? $request->date('tanggal') : null;

        if ($cari !== '') {
            $query->where(function ($builder) use ($cari) {
                $builder->where('judul', 'like', "%{$cari}%")
                    ->orWhereHas('siswa', function ($siswaQuery) use ($cari) {
                        $siswaQuery->where('nama_lengkap', 'like', "%{$cari}%");
                    });
            });
        }

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        // Daftar dan status pengingat dibatasi hanya untuk siswa bimbingan guru ini.
        $siswaBelumMengisiJurnal = Siswa::with(['user.notifications' => function ($builder) {
                $builder->where('data->reminder_type', 'jurnal')
                    ->where('data->reminder_date', today()->toDateString());
            }])
            ->where('guru_id', $guru->id)
            ->whereDoesntHave('jurnals', function ($builder) {
                $builder->whereDate('tanggal', today());
            })
            ->orderBy('nama_lengkap')
            ->get();

        return [
            'guru' => $guru,
            'jurnals' => PaginateHelper::paginate($query->latest('tanggal'), 15),
            'totalJurnal' => Jurnal::whereIn('siswa_id', clone $siswaIds)->count(),
            'jurnalHariIni' => Jurnal::whereIn('siswa_id', clone $siswaIds)->whereDate('tanggal', today())->count(),
            'jurnalBulanIni' => Jurnal::whereIn('siswa_id', clone $siswaIds)
                ->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
            'siswaBelumMengisiJurnal' => $siswaBelumMengisiJurnal,
            'cari' => $cari,
            'tanggal' => $tanggal,
        ];
    }
}
