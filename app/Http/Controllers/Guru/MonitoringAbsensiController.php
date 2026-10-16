<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringAbsensiController extends Controller
{
    public function index(Request $request): View
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $ids = Siswa::where('guru_id', $guru->id)->select('id');
        $query = Absensi::with('siswa')->whereIn('siswa_id', $ids);
        if ($request->filled('tanggal')) $query->whereDate('tanggal', $request->date('tanggal'));
        if ($request->filled('status')) $query->where('status', $request->string('status')->toString());
        return view('guru.absensi.index', ['guru' => $guru, 'absensis' => $query->latest('tanggal')->paginate(15)->withQueryString()]);
    }
}
