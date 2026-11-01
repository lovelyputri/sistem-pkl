<?php

namespace App\Helpers\Siswa;

use App\Models\Absensi;
use App\Models\Jurnal;
use App\Models\Siswa as SiswaModel;

class DashboardHelper
{
    public static function getData(): array
    {
        $siswa = SiswaModel::with(['user','guru.user','sekolah','jurusan','kelas'])
            ->where('user_id', auth()->id())->firstOrFail();

        return [
            'siswa' => $siswa,
            'absensiHariIni' => Absensi::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->first(),
            'jurnalHariIni' => Jurnal::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->first(),
            'totalAbsensi' => Absensi::where('siswa_id', $siswa->id)->count(),
            'totalJurnal' => Jurnal::where('siswa_id', $siswa->id)->count(),
            'jurnalTerbaru' => Jurnal::where('siswa_id', $siswa->id)->latest('tanggal')->latest('id')->take(5)->get(),
            'notifikasiBelumDibaca' => auth()->user()->unreadNotifications()->count(),
        ];
    }
}
