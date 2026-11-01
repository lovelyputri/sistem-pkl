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
        $status = (string) $request->query('status', '');
        $allowed = ['Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpa'];

        $query = Absensi::query()
            ->with(['siswa.sekolah', 'siswa.user'])
            ->when($tanggal !== '', fn ($q) => $q->whereDate('tanggal', $request->date('tanggal')))
            ->when($siswa !== '', fn ($q) => $q->whereHas('siswa', fn ($siswaQuery) => $siswaQuery->where('nama_lengkap', 'like', "%{$siswa}%")))
            ->when(in_array($status, $allowed, true), fn ($q) => $q->where('status', $status))
            ->latest('tanggal');

        return [
            'absensis' => PaginateHelper::paginate($query, 15),
            'statusFilter' => in_array($status, $allowed, true) ? $status : '',
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

        return ['jurnals' => PaginateHelper::paginate($query, 15)];
    }
}
