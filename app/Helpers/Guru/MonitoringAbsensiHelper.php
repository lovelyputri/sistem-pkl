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
        $absensiHariIni = Absensi::whereIn('siswa_id', clone $siswaIds)->whereDate('tanggal', today());
        $sudahAbsen = (clone $absensiHariIni)->distinct()->count('siswa_id');

        $query = Absensi::with('siswa')->whereIn('siswa_id', clone $siswaIds);
        $tanggal = $request->filled('tanggal') ? $request->date('tanggal') : null;
        $status = $request->string('status')->toString();
        $allowed = ['Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpa'];

        if ($tanggal) $query->whereDate('tanggal', $tanggal);
        if (in_array($status, $allowed, true)) $query->where('status', $status);
        else $status = '';

        $siswaBelumAbsen = Siswa::with([
            'user.notifications' => fn ($builder) => $builder->where('data->reminder_type', 'absensi')->where('data->reminder_date', today()->toDateString()),
            'absensis' => fn ($builder) => $builder->whereDate('tanggal', today()),
        ])->where('guru_id', $guru->id)->orderBy('nama_lengkap')->get();

        $jumlahBelumAbsen = $siswaBelumAbsen->filter(fn ($siswa) => $siswa->absensis->isEmpty())->count();

        return [
            'guru' => $guru,
            'absensis' => PaginateHelper::paginate($query->latest('tanggal')->latest('created_at'), 15),
            'totalAbsensiHariIni' => (clone $absensiHariIni)->count(),
            'totalHadir' => (clone $absensiHariIni)->where('status', 'Hadir')->count(),
            'totalTerlambat' => (clone $absensiHariIni)->where('status', 'Terlambat')->count(),
            'totalIzinSakit' => (clone $absensiHariIni)->whereIn('status', ['Izin', 'Sakit'])->count(),
            'totalAlpha' => (clone $absensiHariIni)->where('status', 'Alpa')->count(),
            'totalSiswa' => $totalSiswa,
            'belumAbsen' => max(0, $totalSiswa - $sudahAbsen),
            'siswaBelumAbsen' => $siswaBelumAbsen,
            'jumlahBelumAbsen' => $jumlahBelumAbsen,
            'tanggal' => $tanggal,
            'status' => $status,
        ];
    }
}
