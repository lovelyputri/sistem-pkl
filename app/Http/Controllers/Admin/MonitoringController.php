<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function absensi(Request $request): View
    {
        $query = Absensi::with(['siswa.sekolah', 'siswa.user']);
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->date('tanggal'));
        }
        if ($request->filled('siswa')) {
            $query->whereHas('siswa', fn ($q) => $q->where('nama_lengkap', 'like', '%' . $request->string('siswa') . '%'));
        }
        return view('admin.monitoring.absensi', [
            'absensis' => $query->latest('tanggal')->paginate(15)->withQueryString(),
        ]);
    }

    public function riwayatAbsensi(Request $request): View
    {
        return $this->absensi($request);
    }

    public function jurnal(Request $request): View
    {
        $query = Jurnal::with(['siswa.sekolah', 'siswa.user']);
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->date('tanggal'));
        }
        if ($request->filled('siswa')) {
            $query->whereHas('siswa', fn ($q) => $q->where('nama_lengkap', 'like', '%' . $request->string('siswa') . '%'));
        }
        return view('admin.monitoring.jurnal', [
            'jurnals' => $query->latest('tanggal')->paginate(15)->withQueryString(),
        ]);
    }
}
