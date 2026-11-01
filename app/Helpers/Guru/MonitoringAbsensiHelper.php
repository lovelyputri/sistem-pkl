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

        // Hanya siswa yang ditugaskan kepada guru yang sedang login.
        // Status pengingat diambil agar tombol berubah setelah pengingat dikirim.
        $siswaBelumAbsen = Siswa::with(['user.notifications' => function ($builder) {
                $builder->where('data->reminder_type', 'absensi')
                    ->where('data->reminder_date', today()->toDateString());
            }])
            ->where('guru_id', $guru->id)
            ->whereDoesntHave('absensis', function ($builder) {
                $builder->whereDate('tanggal', today());
            })
            ->orderBy('nama_lengkap')
            ->get();

        $siswaMonitoring = Siswa::with(['absensis' => function ($builder) {
                $builder->whereDate('tanggal', today());
            }])
            ->where('guru_id', $guru->id)
            ->orderBy('nama_lengkap')
            ->get();

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
            'siswaMonitoring' => $siswaMonitoring,
            'tanggal' => $tanggal,
            'status' => $status,
        ];
    }
}
