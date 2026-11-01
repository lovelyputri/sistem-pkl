<?php

namespace App\Helpers\Admin;

use App\Helpers\PaginateHelper;
use App\Models\Absensi;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class MonitoringHelper
{
    public static function getDataAbsensi(Request $request): array
    {
        $tanggal = $request->query('tanggal', '');
        $siswa = trim((string) $request->query('siswa', ''));

        $query = Absensi::query()
            ->with(['siswa.sekolah', 'siswa.user'])
            ->when($tanggal !== '', fn ($q) => $q->whereDate('tanggal', $request->date('tanggal')))
            ->when($siswa !== '', fn ($q) => $q->whereHas('siswa', fn ($siswaQuery) => $siswaQuery->where('nama_lengkap', 'like', "%{$siswa}%")))
            ->latest('tanggal');

        return [
            'absensis' => PaginateHelper::paginate($query, 15),
        ];
    }

    public static function getDataJurnal(Request $request): array
    {
        $tanggal = $request->query('tanggal', '');
        $siswa = trim((string) $request->query('siswa', ''));

        $query = Jurnal::query()
            ->with(['siswa.sekolah', 'siswa.user'])
            ->when($tanggal !== '', fn ($q) => $q->whereDate('tanggal', $request->date('tanggal')))
            ->when($siswa !== '', fn ($q) => $q->whereHas('siswa', fn ($siswaQuery) => $siswaQuery->where('nama_lengkap', 'like', "%{$siswa}%")))
            ->latest('tanggal');

        return [
            'jurnals' => PaginateHelper::paginate($query, 15),
        ];
    }
}
