<?php

namespace App\Helpers\Admin;

use Illuminate\Support\Facades\DB;

class DashboardHelper
{
    public static function getSummary(): array
    {
        return [
            'totalSiswa' => DB::table('siswas')->count(),
            'totalGuru' => DB::table('gurus')->count(),
            'siswaPending' => DB::table('users')
                ->where('role', 'siswa')
                ->where('status', 'pending')
                ->count(),
            'absensiHariIni' => DB::table('absensis')
                ->whereDate('tanggal', today())
                ->count(),
        ];
    }
}
