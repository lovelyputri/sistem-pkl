<?php

namespace App\Helpers\Admin;

use Illuminate\Support\Facades\DB;

class DashboardHelper
{
    /**
     * Mengambil seluruh ringkasan data Dashboard Admin.
     */
    public static function getSummary(): array
    {
        $hariIni = today()->toDateString();

        // ==========================================
        // STATISTIK UTAMA
        // ==========================================

        $totalSiswa = DB::table('siswas')->count();

        $totalGuru = DB::table('gurus')->count();

        $siswaPending = DB::table('users')
            ->where('role', 'siswa')
            ->where('status', 'pending')
            ->count();

        // ==========================================
        // SISWA AKTIF PKL
        // ==========================================

        $querySiswaAktif = self::siswaAktifQuery();

        $totalSiswaAktif = (clone $querySiswaAktif)->count();

        $siswaAktif = (clone $querySiswaAktif)
            ->leftJoin('sekolahs as sk', 's.sekolah_id', '=', 'sk.id')
            ->leftJoin('gurus as g', 's.guru_id', '=', 'g.id')
            ->select(
                's.id',
                's.nama_lengkap',
                's.nisn',
                's.foto_profil',
                's.tanggal_mulai_pkl',
                's.tanggal_selesai_pkl',
                'sk.nama_sekolah',
                'g.nama_lengkap as nama_guru'
            )
            ->orderBy('s.nama_lengkap')
            ->limit(5)
            ->get();

        // ==========================================
        // STATISTIK ABSENSI HARI INI
        // ==========================================

        $absensiHariIni = DB::table('absensis')
            ->whereDate('tanggal', $hariIni)
            ->count();

        $absensiHadir = DB::table('absensis')
            ->whereDate('tanggal', $hariIni)
            ->where('status', 'Hadir')
            ->count();

        $absensiIzin = DB::table('absensis')
            ->whereDate('tanggal', $hariIni)
            ->where('status', 'Izin')
            ->count();

        $absensiSakit = DB::table('absensis')
            ->whereDate('tanggal', $hariIni)
            ->where('status', 'Sakit')
            ->count();

        $absensiAlpa = DB::table('absensis')
            ->whereDate('tanggal', $hariIni)
            ->where('status', 'Alpa')
            ->count();

        // Batas keterlambatan pukul 08.00.
        // Status database tetap Hadir, bukan status baru.

        $absensiTerlambat = DB::table('absensis as a')
            ->join('siswas as s', 'a.siswa_id', '=', 's.id')
            ->whereDate('a.tanggal', $hariIni)
            ->where('a.status', 'Hadir')
            ->whereTime('a.created_at', '>', '08:00:00')
            ->select(
                's.nama_lengkap',
                'a.tanggal',
                'a.created_at'
            )
            ->orderByDesc('a.created_at')
            ->get();

        // ==========================================
        // STATISTIK JURNAL HARI INI
        // ==========================================

        $jurnalHariIni = DB::table('jurnals')
            ->whereDate('tanggal', $hariIni)
            ->count();

        $siswaSudahMengisiJurnal = DB::table('jurnals')
            ->whereDate('tanggal', $hariIni)
            ->distinct('siswa_id')
            ->count('siswa_id');

        // Jurnal yang belum diisi oleh siswa aktif hari ini.

        $jurnalBelumIsi = (clone $querySiswaAktif)
            ->whereNotExists(function ($query) use ($hariIni) {
                $query->select(DB::raw(1))
                    ->from('jurnals as j')
                    ->whereColumn('j.siswa_id', 's.id')
                    ->whereDate('j.tanggal', $hariIni);
            })
            ->count();

        $persentaseJurnal = $totalSiswaAktif > 0
            ? round(($siswaSudahMengisiJurnal / $totalSiswaAktif) * 100)
            : 0;

        // ==========================================
        // AKTIVITAS TERBARU
        // ==========================================

        $aktivitasAbsensi = DB::table('absensis as a')
            ->join('siswas as s', 'a.siswa_id', '=', 's.id')
            ->select(
                's.nama_lengkap',
                'a.status as keterangan',
                'a.created_at',
                DB::raw("'absensi' as jenis")
            )
            ->orderByDesc('a.created_at')
            ->limit(5)
            ->get();

        $aktivitasJurnal = DB::table('jurnals as j')
            ->join('siswas as s', 'j.siswa_id', '=', 's.id')
            ->select(
                's.nama_lengkap',
                'j.judul as keterangan',
                'j.created_at',
                DB::raw("'jurnal' as jenis")
            )
            ->orderByDesc('j.created_at')
            ->limit(5)
            ->get();

        $aktivitasTerbaru = $aktivitasAbsensi
            ->concat($aktivitasJurnal)
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        // ==========================================
        // RETURN DATA KE BLADE
        // ==========================================

        return [
            'totalSiswa' => $totalSiswa,
            'totalGuru' => $totalGuru,
            'siswaPending' => $siswaPending,

            'totalSiswaAktif' => $totalSiswaAktif,
            'siswaAktif' => $siswaAktif,

            'absensiHariIni' => $absensiHariIni,
            'absensiHadir' => $absensiHadir,
            'absensiIzin' => $absensiIzin,
            'absensiSakit' => $absensiSakit,
            'absensiAlpa' => $absensiAlpa,
            'absensiTerlambat' => $absensiTerlambat,

            'jurnalHariIni' => $jurnalHariIni,
            'siswaSudahMengisiJurnal' => $siswaSudahMengisiJurnal,
            'jurnalBelumIsi' => $jurnalBelumIsi,
            'persentaseJurnal' => $persentaseJurnal,

            'aktivitasTerbaru' => $aktivitasTerbaru,
        ];
    }

    /**
     * Query dasar siswa yang sedang menjalani PKL.
     */
    private static function siswaAktifQuery()
    {
        return DB::table('siswas as s')
            ->join('users as u', 's.user_id', '=', 'u.id')
            ->where('u.status', 'approved')
            ->where(function ($query) {
                $query->whereNull('s.tanggal_mulai_pkl')
                    ->orWhereDate('s.tanggal_mulai_pkl', '<=', today());
            })
            ->where(function ($query) {
                $query->whereNull('s.tanggal_selesai_pkl')
                    ->orWhereDate('s.tanggal_selesai_pkl', '>=', today());
            });
    }
}
