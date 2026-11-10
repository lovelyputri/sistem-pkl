<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\MonitoringHelper;
use App\Models\PengajuanIzin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function absensi(Request $request): View
    {
        return view('admin.monitoring.absensi', MonitoringHelper::getDataAbsensi($request));
    }

    public function jurnal(Request $request): View
    {
        return view('admin.monitoring.jurnal', MonitoringHelper::getDataJurnal($request));
    }

    public function showJurnal(\App\Models\Jurnal $jurnal): View
    {
        $jurnal->load('siswa.sekolah', 'siswa.jurusan', 'siswa.kelas');
        return view('admin.monitoring.jurnal-show', compact('jurnal'));
    }

    public function suratIzin(PengajuanIzin $izin)
    {
        abort_unless($izin->surat_path, 404);
        abort_unless(Storage::disk('public')->exists($izin->surat_path), 404);

        return Storage::disk('public')->response($izin->surat_path);
    }
}
