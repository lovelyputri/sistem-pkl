<?php

namespace App\Helpers\Siswa;

use App\Models\Absensi;
use App\Models\Jurnal;
use App\Models\Siswa as SiswaModel;

class DashboardHelper
{
    public static function getData(): array
    {
        $siswa = SiswaModel::with(['user', 'guru.user', 'sekolah', 'jurusan', 'kelas'])
            ->where('user_id', auth()->id())->firstOrFail();

        $absensi = Absensi::where('siswa_id', $siswa->id);
        $jurnal = Jurnal::where('siswa_id', $siswa->id);
        $bulanIni = now();

        return [
            'siswa' => $siswa,
            'absensiHariIni' => (clone $absensi)->whereDate('tanggal', today())->first(),
            'jurnalHariIni' => (clone $jurnal)->whereDate('tanggal', today())->first(),
            'totalAbsensi' => (clone $absensi)->count(),
            'totalJurnal' => (clone $jurnal)->count(),
            'absensiBulanIni' => (clone $absensi)->whereMonth('tanggal', $bulanIni->month)->whereYear('tanggal', $bulanIni->year)->count(),
            'jurnalBulanIni' => (clone $jurnal)->whereMonth('tanggal', $bulanIni->month)->whereYear('tanggal', $bulanIni->year)->count(),
            'totalTerlambat' => (clone $absensi)->where('status', 'Terlambat')->count(),
            'notifikasiBelumDibaca' => auth()->user()->unreadNotifications()->count(),
        ];
    }
}
