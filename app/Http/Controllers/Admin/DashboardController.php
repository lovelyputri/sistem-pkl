<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan ringkasan dashboard Admin.
     */
    public function index()
    {
        $totalSiswa = DB::table('siswas')->count();
        $totalGuru = DB::table('gurus')->count();

        $siswaPending = DB::table('users')
            ->where('role', 'siswa')
            ->where('status', 'pending')
            ->count();

        $absensiHariIni = DB::table('absensis')
            ->whereDate('tanggal', today())
            ->count();

        // Tabel perusahaan tersedia setelah migration perusahaan dijalankan.
        $totalPerusahaan = 0;
        if (DB::getSchemaBuilder()->hasTable('perusahaans')) {
            $totalPerusahaan = DB::table('perusahaans')->count();
        }

        return view('dashboard.admin', compact(
            'totalSiswa',
            'totalGuru',
            'siswaPending',
            'absensiHariIni',
            'totalPerusahaan'
        ));
    }
}
