<?php

namespace App\Helpers\Siswa;

use App\Helpers\PaginateHelper;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiHelper
{
    public static function getDataIndex(Request $request): array
    {
        $siswa = Siswa::where('user_id', auth()->id())->firstOrFail();
        $query = Absensi::where('siswa_id', $siswa->id);
        if ($request->filled('bulan') && preg_match('/^\d{4}-\d{2}$/', $request->string('bulan')->toString())) {
            [$year, $month] = explode('-', $request->string('bulan')->toString());
            $query->whereYear('tanggal', (int) $year)->whereMonth('tanggal', (int) $month);
        }
        $base = Absensi::where('siswa_id', $siswa->id);
        return [
            'siswa' => $siswa,
            'absensis' => PaginateHelper::paginate($query->latest('tanggal')->latest('created_at'), 15),
            'absensiHariIni' => (clone $base)->whereDate('tanggal', today())->first(),
            'totalHadir' => (clone $base)->where('status', 'Hadir')->count(),
            'totalTerlambat' => (clone $base)->where('status', 'Terlambat')->count(),
            'totalIzin' => (clone $base)->where('status', 'Izin')->count(),
            'totalSakit' => (clone $base)->where('status', 'Sakit')->count(),
            'totalAlpa' => (clone $base)->where('status', 'Alpa')->count(),
        ];
    }
}
