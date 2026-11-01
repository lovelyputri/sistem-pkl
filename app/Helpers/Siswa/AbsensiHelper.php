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
        return [
            'siswa' => $siswa,
            'absensis' => PaginateHelper::paginate($query->latest('tanggal'), 15),
            'absensiHariIni' => Absensi::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->first(),
            'totalHadir' => Absensi::where('siswa_id', $siswa->id)->where('status', 'Hadir')->count(),
            'totalIzin' => Absensi::where('siswa_id', $siswa->id)->where('status', 'Izin')->count(),
            'totalSakit' => Absensi::where('siswa_id', $siswa->id)->where('status', 'Sakit')->count(),
            'totalAlpa' => Absensi::where('siswa_id', $siswa->id)->where('status', 'Alpa')->count(),
        ];
    }
}
