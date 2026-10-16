<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaBimbinganController extends Controller
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

        $query = Siswa::with(['sekolah', 'kelas', 'jurusan', 'user'])->where('guru_id', $guru->id);
        if ($request->filled('cari')) {
            $cari = $request->string('cari')->toString();
            $query->where(fn ($q) => $q->where('nama_lengkap', 'like', "%{$cari}%")->orWhere('nisn', 'like', "%{$cari}%"));
        }

        return view('guru.siswa.index', [
            'guru' => $guru,
            'siswas' => $query->orderBy('nama_lengkap')->paginate(15)->withQueryString(),
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
