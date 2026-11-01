<?php

namespace App\Helpers\Guru;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;

class DashboardHelper
{
    public static function getData(): array
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $siswaIds = Siswa::where('guru_id', $guru->id)->select('id');

        $absensiHariIni = Absensi::whereIn('siswa_id', clone $siswaIds)
            ->whereDate('tanggal', today());

        return [
            'guru' => $guru,
            'totalSiswa' => (clone $siswaIds)->count(),
            'totalAbsensiHariIni' => (clone $absensiHariIni)->count(),
            'sudahAbsen' => (clone $absensiHariIni)->distinct()->count('siswa_id'),
            'belumAbsen' => max(0, (clone $siswaIds)->count() - (clone $absensiHariIni)->distinct()->count('siswa_id')),
            'totalHadir' => (clone $absensiHariIni)->whereIn('status', ['hadir', 'Hadir'])->count(),
            'totalIzinSakit' => (clone $absensiHariIni)->whereIn('status', ['izin', 'Izin', 'sakit', 'Sakit'])->count(),
            'totalJurnal' => Jurnal::whereIn('siswa_id', clone $siswaIds)->count(),
            'jurnalTerbaru' => Jurnal::with('siswa')
                ->whereIn('siswa_id', clone $siswaIds)
                ->latest('tanggal')
                ->take(5)
                ->get(),
        ];
    }
}
