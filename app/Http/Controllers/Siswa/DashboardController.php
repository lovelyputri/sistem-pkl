<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $siswa = Siswa::with(['user', 'sekolah', 'jurusan', 'kelas', 'guru.user'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $absensiHariIni = Absensi::where('siswa_id', $siswa->id)
            ->whereDate('tanggal', today())
            ->first();

        return view('siswa.dashboard', [
            'siswa' => $siswa,
            'absensiHariIni' => $absensiHariIni,
            'totalHadir' => Absensi::where('siswa_id', $siswa->id)->where('status', 'Hadir')->count(),
            'totalIzinSakit' => Absensi::where('siswa_id', $siswa->id)->whereIn('status', ['Izin', 'Sakit'])->count(),
            'totalJurnal' => Jurnal::where('siswa_id', $siswa->id)->count(),
            'jurnalTerbaru' => Jurnal::where('siswa_id', $siswa->id)->latest('tanggal')->latest('id')->take(5)->get(),
        ]);
    }
}
