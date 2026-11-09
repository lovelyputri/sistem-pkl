<?php

namespace App\Helpers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardHelper
{
    /**
     * Menyiapkan seluruh data yang dibutuhkan Dashboard Admin.
     */
    public static function getSummary(): array
    {
        $hariIni = today()->toDateString();
        $jamBatas = '08:00:00';

        $siswaAktifQuery = DB::table('siswas')
            ->where(function ($query) use ($hariIni) {
                $query->whereNull('tanggal_selesai_pkl')
                    ->orWhereDate('tanggal_selesai_pkl', '>=', $hariIni);
            });

        $totalSiswa = (clone $siswaAktifQuery)->count();
        $totalGuru = DB::table('gurus')->count();
        $siswaPending = DB::table('users')
            ->where('role', 'siswa')
            ->where('status', 'pending')
            ->count();

        $absensiHariIni = DB::table('absensis')->whereDate('tanggal', $hariIni);
        $jumlahAbsensi = (clone $absensiHariIni)->count();

        $statusAbsensi = (clone $absensiHariIni)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $jumlahHadir = (int) ($statusAbsensi['Hadir'] ?? 0);
        $jumlahIzin = (int) ($statusAbsensi['Izin'] ?? 0);
        $jumlahSakit = (int) ($statusAbsensi['Sakit'] ?? 0);
        $jumlahAlpa = (int) ($statusAbsensi['Alpa'] ?? 0);
        $jumlahTerlambat = (clone $absensiHariIni)
            ->where('status', 'Hadir')
            ->whereTime('created_at', '>', $jamBatas)
            ->count();

        $jurnalHariIni = DB::table('jurnals')->whereDate('tanggal', $hariIni);
        $siswaIsiJurnal = (clone $jurnalHariIni)->distinct('siswa_id')->count('siswa_id');
        $jurnalBelumIsi = max(0, $totalSiswa - $siswaIsiJurnal);
        $persentaseJurnal = $totalSiswa > 0
            ? (int) round(($siswaIsiJurnal / $totalSiswa) * 100)
            : 0;

        $siswaTerbaru = (clone $siswaAktifQuery)
            ->leftJoin('sekolahs', 'siswas.sekolah_id', '=', 'sekolahs.id')
            ->leftJoin('gurus', 'siswas.guru_id', '=', 'gurus.id')
            ->select(
                'siswas.id',
                'siswas.nama_lengkap',
                'siswas.foto_profil',
                'siswas.tanggal_mulai_pkl',
                'siswas.tanggal_selesai_pkl',
                'sekolahs.nama_sekolah',
                'gurus.nama_lengkap as nama_guru'
            )
            ->orderByDesc('siswas.created_at')
            ->limit(5)
            ->get();

        $aktivitasAbsensi = DB::table('absensis')
            ->join('siswas', 'absensis.siswa_id', '=', 'siswas.id')
            ->whereDate('absensis.tanggal', $hariIni)
            ->select(
                'siswas.nama_lengkap',
                'absensis.status',
                'absensis.created_at'
            )
            ->latest('absensis.created_at')
            ->limit(5)
            ->get()
            ->map(fn ($item) => [
                'jenis' => 'absensi',
                'judul' => $item->nama_lengkap . ' mengirim presensi',
                'deskripsi' => 'Status: ' . $item->status,
                'waktu' => $item->created_at,
                'timestamp' => Carbon::parse($item->created_at)->timestamp,
            ]);

        $aktivitasJurnal = DB::table('jurnals')
            ->join('siswas', 'jurnals.siswa_id', '=', 'siswas.id')
            ->whereDate('jurnals.tanggal', $hariIni)
            ->select(
                'siswas.nama_lengkap',
                'jurnals.judul',
                'jurnals.created_at'
            )
            ->latest('jurnals.created_at')
            ->limit(5)
            ->get()
            ->map(fn ($item) => [
                'jenis' => 'jurnal',
                'judul' => $item->nama_lengkap . ' mengisi jurnal',
                'deskripsi' => $item->judul,
                'waktu' => $item->created_at,
                'timestamp' => Carbon::parse($item->created_at)->timestamp,
            ]);

        $aktivitasTerbaru = $aktivitasAbsensi
            ->concat($aktivitasJurnal)
            ->sortByDesc('timestamp')
            ->take(6)
            ->values();

        return [
            'totalSiswa' => $totalSiswa,
            'totalGuru' => $totalGuru,
            'siswaPending' => $siswaPending,
            'absensiHariIni' => $jumlahAbsensi,
            'tanggalDashboard' => now()->translatedFormat('l, d F Y'),
            'jumlahHadir' => $jumlahHadir,
            'jumlahIzin' => $jumlahIzin,
            'jumlahSakit' => $jumlahSakit,
            'jumlahAlpa' => $jumlahAlpa,
            'jumlahTerlambat' => $jumlahTerlambat,
            'siswaIsiJurnal' => $siswaIsiJurnal,
            'jurnalBelumIsi' => $jurnalBelumIsi,
            'persentaseJurnal' => $persentaseJurnal,
            'siswaTerbaru' => $siswaTerbaru,
            'aktivitasTerbaru' => $aktivitasTerbaru,
        ];
    }
}
