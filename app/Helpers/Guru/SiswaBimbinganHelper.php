<?php

namespace App\Helpers\Guru;

use App\Helpers\PaginateHelper;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaBimbinganHelper
{
    public static function getDataIndex(Request $request): array
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $siswaQuery = Siswa::where('guru_id', $guru->id)->where(function ($q) {
            $q->whereNull('tanggal_selesai_pkl')->orWhereDate('tanggal_selesai_pkl', '>=', today());
        });
        $totalSiswa = (clone $siswaQuery)->count();
        $totalSekolah = (clone $siswaQuery)->whereNotNull('sekolah_id')->distinct()->count('sekolah_id');
        $totalJurusan = (clone $siswaQuery)->whereNotNull('jurusan_id')->distinct()->count('jurusan_id');

        $query = Siswa::with(['sekolah', 'kelas', 'jurusan', 'user'])
            ->where('guru_id', $guru->id)
            ->where(function ($q) {
                $q->whereNull('tanggal_selesai_pkl')->orWhereDate('tanggal_selesai_pkl', '>=', today());
            });

        $cari = trim($request->string('cari')->toString());
        if ($cari !== '') {
            $query->where(fn ($builder) => $builder->where('nama_lengkap', 'like', "%{$cari}%")->orWhere('nisn', 'like', "%{$cari}%"));
        }

        return [
            'guru' => $guru,
            'siswas' => PaginateHelper::paginate($query->orderBy('nama_lengkap'), 15),
            'totalSiswa' => $totalSiswa,
            'totalSekolah' => $totalSekolah,
            'totalJurusan' => $totalJurusan,
            'cari' => $cari,
        ];
    }

    public static function getDataShow(Siswa $siswa, Request $request): array
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        abort_unless((int) $siswa->guru_id === (int) $guru->id, 404);

        $bulan = $request->query('bulan', now()->format('Y-m'));
        if (!preg_match('/^\d{4}-\d{2}$/', $bulan)) $bulan = now()->format('Y-m');
        [$tahun, $nomorBulan] = array_map('intval', explode('-', $bulan));

        $siswa->load(['user', 'sekolah', 'jurusan', 'kelas']);
        $absensi = Absensi::where('siswa_id', $siswa->id)->whereYear('tanggal', $tahun)->whereMonth('tanggal', $nomorBulan);
        $jurnal = Jurnal::where('siswa_id', $siswa->id)->whereYear('tanggal', $tahun)->whereMonth('tanggal', $nomorBulan);

        return [
            'siswa' => $siswa,
            'bulan' => $bulan,
            'totalAbsensi' => (clone $absensi)->count(),
            'totalHadir' => (clone $absensi)->where('status', 'Hadir')->count(),
            'totalTerlambat' => (clone $absensi)->where('status', 'Terlambat')->count(),
            'totalIzin' => (clone $absensi)->where('status', 'Izin')->count(),
            'totalSakit' => (clone $absensi)->where('status', 'Sakit')->count(),
            'totalAlpa' => (clone $absensi)->where('status', 'Alpa')->count(),
            'totalJurnal' => (clone $jurnal)->count(),
            'riwayatAbsensi' => (clone $absensi)->latest('tanggal')->get(),
            'riwayatJurnal' => (clone $jurnal)->latest('tanggal')->take(5)->get(),
        ];
    }
}
