<?php

namespace App\Helpers\Guru;

use App\Helpers\PaginateHelper;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class MonitoringAbsensiHelper
{
    public static function getDataIndex(Request $request): array
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $siswaIds = Siswa::where('guru_id', $guru->id)->select('id');

        $totalSiswa = (clone $siswaIds)->count();
        $absensiHariIni = Absensi::whereIn('siswa_id', clone $siswaIds)
            ->whereDate('tanggal', today());
        $sudahAbsen = (clone $absensiHariIni)->distinct()->count('siswa_id');

        $query = Absensi::with('siswa')
            ->whereIn('siswa_id', clone $siswaIds);

        $tanggal = $request->filled('tanggal') ? $request->date('tanggal') : null;
        $status = $request->string('status')->toString();

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        if (in_array($status, ['hadir', 'izin', 'sakit', 'alpha', 'terlambat'], true)) {
            $query->where('status', $status);
        } else {
            $status = '';
        }

        // Semua siswa bimbingan ditampilkan dalam satu daftar dengan status absensi hari ini.
        $siswaBelumAbsen = Siswa::with([
                'user.notifications' => function ($builder) {
                    $builder->where('data->reminder_type', 'absensi')
                        ->where('data->reminder_date', today()->toDateString());
                },
                'absensis' => function ($builder) {
                    $builder->whereDate('tanggal', today());
                },
            ])
            ->where('guru_id', $guru->id)
            ->orderBy('nama_lengkap')
            ->get();

        $jumlahBelumAbsen = $siswaBelumAbsen->filter(
            fn ($siswa) => $siswa->absensis->isEmpty()
        )->count();

        return [
            'guru' => $guru,
            'absensis' => PaginateHelper::paginate($query->latest('tanggal'), 15),
            'totalAbsensiHariIni' => (clone $absensiHariIni)->count(),
            'totalHadir' => (clone $absensiHariIni)->whereIn('status', ['hadir', 'Hadir'])->count(),
            'totalIzinSakit' => (clone $absensiHariIni)->whereIn('status', ['izin', 'Izin', 'sakit', 'Sakit'])->count(),
            'totalAlpha' => (clone $absensiHariIni)->whereIn('status', ['alpha', 'Alpha'])->count(),
            'totalSiswa' => $totalSiswa,
            'belumAbsen' => max(0, $totalSiswa - $sudahAbsen),
            'siswaBelumAbsen' => $siswaBelumAbsen,
            'jumlahBelumAbsen' => $jumlahBelumAbsen,
            'tanggal' => $tanggal,
            'status' => $status,
        ];
    }
}
