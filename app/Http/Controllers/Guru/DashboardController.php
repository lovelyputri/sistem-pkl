<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private function guru(): Guru
    {
        return Guru::where('user_id', auth()->id())->firstOrFail();
    }

    public function index(): View
    {
        $guru = $this->guru();
        $siswaIds = Siswa::where('guru_id', $guru->id)->pluck('id');

        return view('guru.dashboard', [
            'guru' => $guru,
            'totalSiswa' => $siswaIds->count(),
            'absensiHariIni' => Absensi::whereIn('siswa_id', $siswaIds)->whereDate('tanggal', today())->count(),
            'totalJurnal' => Jurnal::whereIn('siswa_id', $siswaIds)->count(),
            'jurnalTerbaru' => Jurnal::with('siswa')->whereIn('siswa_id', $siswaIds)->latest('tanggal')->take(5)->get(),
        ]);
    }

    public function siswa(Request $request): View
    {
        $guru = $this->guru();
        $query = Siswa::with(['sekolah', 'kelas', 'jurusan', 'user'])->where('guru_id', $guru->id);

        if ($request->filled('cari')) {
            $cari = $request->string('cari')->toString();
            $query->where(function ($q) use ($cari) {
                $q->where('nama_lengkap', 'like', "%{$cari}%")
                  ->orWhere('nisn', 'like', "%{$cari}%");
            });
        }

        return view('guru.siswa.index', [
            'guru' => $guru,
            'siswas' => $query->orderBy('nama_lengkap')->paginate(15)->withQueryString(),
        ]);
    }

    public function absensi(Request $request): View
    {
        $guru = $this->guru();
        $ids = Siswa::where('guru_id', $guru->id)->select('id');
        $query = Absensi::with('siswa')->whereIn('siswa_id', $ids);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->date('tanggal'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        return view('guru.absensi.index', [
            'guru' => $guru,
            'absensis' => $query->latest('tanggal')->paginate(15)->withQueryString(),
        ]);
    }

    public function jurnal(Request $request): View
    {
        $guru = $this->guru();
        $ids = Siswa::where('guru_id', $guru->id)->select('id');
        $query = Jurnal::with('siswa')->whereIn('siswa_id', $ids);

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->date('tanggal'));
        }
        if ($request->filled('cari')) {
            $cari = $request->string('cari')->toString();
            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                  ->orWhereHas('siswa', fn ($s) => $s->where('nama_lengkap', 'like', "%{$cari}%"));
            });
        }

        return view('guru.jurnal.index', [
            'guru' => $guru,
            'jurnals' => $query->latest('tanggal')->paginate(15)->withQueryString(),
        ]);
    }

    public function profil(): View
    {
        return view('guru.profil', ['guru' => $this->guru()->load('sekolah', 'user')]);
    }
}
