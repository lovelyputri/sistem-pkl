<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Jurnal;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $ids = Siswa::where('guru_id', $guru->id)->pluck('id');
        $absensiHariIni = Absensi::whereIn('siswa_id', $ids)->whereDate('tanggal', today());
        $totalSiswa = $ids->count();
        $sudahAbsen = (clone $absensiHariIni)->distinct()->count('siswa_id');

        return view('guru.dashboard', [
            'guru' => $guru,
            'totalSiswa' => $totalSiswa,
            'totalAbsensiHariIni' => (clone $absensiHariIni)->count(),
            'sudahAbsen' => $sudahAbsen,
            'belumAbsen' => max(0, $totalSiswa - $sudahAbsen),
            'totalHadir' => (clone $absensiHariIni)->whereIn('status', ['hadir', 'Hadir'])->count(),
            'totalIzinSakit' => (clone $absensiHariIni)->whereIn('status', ['izin', 'Izin', 'sakit', 'Sakit'])->count(),
            'totalJurnal' => Jurnal::whereIn('siswa_id', $ids)->count(),
            'jurnalTerbaru' => Jurnal::with('siswa')->whereIn('siswa_id', $ids)->latest('tanggal')->take(5)->get(),
        ]);
    }
}
