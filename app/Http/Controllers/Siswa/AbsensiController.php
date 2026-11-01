<?php

namespace App\Http\Controllers\Siswa;

use App\Helpers\Siswa\AbsensiHelper;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    public function index(Request $request): View
    {
        return view('siswa.absensi.index', AbsensiHelper::getDataIndex($request));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'latitude' => ['required','numeric','between:-90,90'],
            'longitude' => ['required','numeric','between:-180,180'],
            'keterangan' => ['nullable','string','max:500'],
        ], [
            'latitude.required' => 'Lokasi belum berhasil didapatkan. Izinkan akses lokasi terlebih dahulu.',
            'longitude.required' => 'Lokasi belum berhasil didapatkan. Izinkan akses lokasi terlebih dahulu.',
        ]);

        $siswa = Siswa::where('user_id', $request->user()->id)->firstOrFail();
        $sudahAbsen = Absensi::where('siswa_id',$siswa->id)->whereDate('tanggal',today())->exists();
        if ($sudahAbsen) return back()->with('error','Kamu sudah mengisi absensi hari ini.');

        DB::transaction(function () use ($siswa, $data) {
            Absensi::create([
                'siswa_id' => $siswa->id,
                'tanggal' => today(),
                'status' => 'Hadir',
                'keterangan' => $data['keterangan'] ?? null,
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
            ]);
        });

        return redirect()->route('siswa.absensi.index')->with('success','Absensi berhasil disimpan.');
    }
}
