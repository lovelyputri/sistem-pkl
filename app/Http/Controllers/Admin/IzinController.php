<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class IzinController extends Controller
{
    public function index(Request $request): View
    {
        $query = PengajuanIzin::with('siswa.sekolah', 'guru')->latest();

        if ($request->filled('status') && in_array($request->status, ['Menunggu', 'Disetujui', 'Ditolak'], true)) {
            $query->where('status', $request->status);
        }
        if ($request->filled('siswa')) {
            $query->whereHas('siswa', fn ($q) => $q->where('nama_lengkap', 'like', '%' . $request->siswa . '%'));
        }

        $totalMenunggu = PengajuanIzin::where('status', 'Menunggu')->count();
        $totalDisetujui = PengajuanIzin::where('status', 'Disetujui')->count();
        $totalDitolak = PengajuanIzin::where('status', 'Ditolak')->count();
        $pengajuans = $query->paginate(15)->withQueryString();

        return view('admin.izin.index', compact('pengajuans', 'totalMenunggu', 'totalDisetujui', 'totalDitolak'));
    }

    public function surat(PengajuanIzin $izin)
    {
        abort_unless(Storage::disk('public')->exists($izin->surat_path), 404);
        return Storage::disk('public')->response($izin->surat_path);
    }
}
