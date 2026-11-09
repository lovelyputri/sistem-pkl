<?php

namespace App\\Helpers\\Admin;

use Illuminate\\Support\\Facades\\DB;

class DashboardHelper
{
    /**
     * Menyiapkan data ringkasan untuk Dashboard Admin.
     */
    public static function getSummary(): array
    {
        $hariIni = today()->toDateString();

        return [
            'totalSiswa' => DB::table('siswas')->count(),
            'totalGuru' => DB::table('gurus')->count(),
            'siswaPending' => DB::table('users')
                ->where('role', 'siswa')
                ->where('status', 'pending')
                ->count(),
            'absensiHariIni' => DB::table('absensis')
                ->whereDate('tanggal', $hariIni)
                ->count(),
            'tanggalDashboard' => today()->format('d/m/Y'),
        ];
    }
}
