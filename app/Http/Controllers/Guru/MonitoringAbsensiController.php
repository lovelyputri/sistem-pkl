<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringAbsensiController extends Controller
{
    public function index(Request $request): View
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $siswaIds = Siswa::where('guru_id', $guru->id)->select('id');
        $totalSiswa = (clone $siswaIds)->count();
        $absensiHariIni = Absensi::whereIn('siswa_id', (clone $siswaIds))
            ->whereDate('tanggal', today());
        $sudahAbsen = (clone $absensiHariIni)->distinct('siswa_id')->count('siswa_id');
        $totalHadir = (clone $absensiHariIni)->whereIn('status', ['hadir', 'Hadir'])->count();
        $totalIzinSakit = (clone $absensiHariIni)->whereIn('status', ['izin', 'Izin', 'sakit', 'Sakit'])->count();
        $totalJurnal = Jurnal::whereIn('siswa_id', (clone $siswaIds))->count();

        $query = Absensi::with('siswa')->whereIn('siswa_id', (clone $siswaIds));
        if ($request->filled('tanggal')) $query->whereDate('tanggal', $request->date('tanggal'));
        if ($request->filled('status')) $query->where('status', $request->string('status')->toString());

        return view('guru.absensi.index', [
            'guru' => $guru,
            'absensis' => $query->latest('tanggal')->paginate(15)->withQueryString(),
            'totalSiswa' => $totalSiswa,
            'sudahAbsen' => $sudahAbsen,
            'belumAbsen' => max(0, $totalSiswa - $sudahAbsen),
            'totalAbsensiHariIni' => (clone $absensiHariIni)->count(),
            'totalHadir' => $totalHadir,
            'totalIzinSakit' => $totalIzinSakit,
            'totalJurnal' => $totalJurnal,
        ]);
    }
}
