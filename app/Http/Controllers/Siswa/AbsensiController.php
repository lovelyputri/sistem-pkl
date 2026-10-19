<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    private function siswa(): Siswa
    {
        return Siswa::where('user_id', auth()->id())->firstOrFail();
    }

    public function index(): View
    {
        $siswa = $this->siswa();
        $riwayat = Absensi::where('siswa_id', $siswa->id)
            ->latest('tanggal')->latest('id')->paginate(10);

        return view('siswa.absensi.index', [
            'siswa' => $siswa,
            'absensiHariIni' => Absensi::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->first(),
            'riwayat' => $riwayat,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $siswa = $this->siswa();

        if (Absensi::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->exists()) {
            return back()->with('error', 'Kamu sudah melakukan absensi hari ini.');
        }

        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'keterangan' => ['nullable', 'string', 'max:500'],
        ]);

        Absensi::create([
            'siswa_id' => $siswa->id,
            'tanggal' => today(),
            'status' => 'Hadir',
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()->route('siswa.absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }
}
