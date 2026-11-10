<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\PengajuanIzin;
use App\Notifications\PengajuanIzinNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PersetujuanIzinController extends Controller
{
    public function index(Request $request): View
    {
        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();
        $query = PengajuanIzin::with('siswa')->where('guru_id', $guru->id);

        if ($request->filled('status') && in_array($request->status, ['Menunggu', 'Disetujui', 'Ditolak'], true)) {
            $query->where('status', $request->status);
        }

        $jumlahMenunggu = PengajuanIzin::where('guru_id', $guru->id)->where('status', 'Menunggu')->count();
        $pengajuans = $query->latest()->paginate(10)->withQueryString();

        return view('guru.izin.index', compact('pengajuans', 'jumlahMenunggu'));
    }

    public function show(Request $request, PengajuanIzin $izin): View
    {
        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();
        abort_unless((int) $izin->guru_id === (int) $guru->id, 404);
        $izin->load('siswa.sekolah', 'siswa.jurusan');
        $request->user()->unreadNotifications()
            ->where('data->url', route('guru.izin.show', $izin->id))
            ->get()->each->markAsRead();

        return view('guru.izin.show', compact('izin'));
    }

    public function surat(Request $request, PengajuanIzin $izin)
    {
        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();
        abort_unless((int) $izin->guru_id === (int) $guru->id, 404);
        abort_unless(Storage::disk('public')->exists($izin->surat_path), 404);

        return Storage::disk('public')->response($izin->surat_path);
    }

    public function update(Request $request, PengajuanIzin $izin): RedirectResponse
    {
        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();
        abort_unless((int) $izin->guru_id === (int) $guru->id, 404);
        abort_unless($izin->status === 'Menunggu', 404);

        $data = $request->validate([
            'keputusan' => ['required', 'in:Disetujui,Ditolak'],
            'catatan_guru' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($data['keputusan'] === 'Disetujui') {
            foreach (CarbonPeriod::create($izin->tanggal_mulai, $izin->tanggal_selesai) as $tanggal) {
                $sudahAbsen = Absensi::where('siswa_id', $izin->siswa_id)
                    ->whereDate('tanggal', $tanggal->toDateString())->exists();
                if ($sudahAbsen) {
                    return back()->with('error', 'Pengajuan tidak dapat disetujui karena siswa sudah memiliki catatan absensi pada salah satu tanggal tersebut.');
                }
            }
        }

        DB::transaction(function () use ($izin, $data, $request) {
            $izin->update([
                'status' => $data['keputusan'],
                'catatan_guru' => $data['catatan_guru'] ?? null,
                'diproses_oleh' => $request->user()->id,
                'diproses_pada' => now(),
            ]);

            if ($data['keputusan'] === 'Disetujui') {
                foreach (CarbonPeriod::create($izin->tanggal_mulai, $izin->tanggal_selesai) as $tanggal) {
                    Absensi::create([
                        'siswa_id' => $izin->siswa_id,
                        'tanggal' => $tanggal->toDateString(),
                        'status' => 'Izin',
                        'keterangan' => 'Pengajuan izin disetujui: ' . $izin->jenis_izin,
                        'latitude' => null,
                        'longitude' => null,
                    ]);
                }
            }
        });

        $izin->loadMissing('siswa.user');
        if ($izin->siswa?->user) {
            $izin->siswa->user->notify(new PengajuanIzinNotification(
                'Pengajuan izin ' . strtolower($izin->status),
                'Pengajuan izin tanggal ' . $izin->tanggal_mulai->format('d M Y') . ' telah ' . strtolower($izin->status) . '.',
                route('siswa.izin.index'),
                'hasil_izin'
            ));
        }

        return redirect()->route('guru.izin.show', $izin)->with('success', 'Keputusan pengajuan izin berhasil disimpan.');
    }
}
