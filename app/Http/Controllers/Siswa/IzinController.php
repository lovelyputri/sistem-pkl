<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\PengajuanIzin;
use App\Models\Siswa;
use App\Notifications\PengajuanIzinNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class IzinController extends Controller
{
    public function index(Request $request): View
    {
        $siswa = Siswa::where('user_id', $request->user()->id)->firstOrFail();
        $pengajuans = PengajuanIzin::where('siswa_id', $siswa->id)
            ->latest()->paginate(10)->withQueryString();

        return view('siswa.izin.index', compact('pengajuans'));
    }

    public function create(): View
    {
        return view('siswa.izin.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tanggal_mulai' => ['required', 'date', 'after_or_equal:today'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'jenis_izin' => ['required', 'in:Sakit,Keperluan Lain'],
            'alasan' => ['required', 'string', 'max:1500'],
            'surat' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ], [
            'surat.required' => 'Surat atau bukti izin wajib diunggah.',
            'surat.mimes' => 'Berkas harus berupa PDF, JPG, JPEG, atau PNG.',
            'surat.max' => 'Ukuran berkas maksimal 5 MB.',
        ]);

        $siswa = Siswa::where('user_id', $request->user()->id)->firstOrFail();

        $masihMenunggu = PengajuanIzin::where('siswa_id', $siswa->id)
            ->where('status', 'Menunggu')
            ->whereDate('tanggal_mulai', '<=', $data['tanggal_selesai'])
            ->whereDate('tanggal_selesai', '>=', $data['tanggal_mulai'])
            ->exists();

        if ($masihMenunggu) {
            return back()->withInput()->with('error', 'Masih ada pengajuan izin yang menunggu persetujuan pada rentang tanggal tersebut.');
        }

        $path = $request->file('surat')->store('surat-izin', 'public');

        $pengajuan = PengajuanIzin::create([
            'siswa_id' => $siswa->id,
            'guru_id' => $siswa->guru_id,
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'jenis_izin' => $data['jenis_izin'],
            'alasan' => $data['alasan'],
            'surat_path' => $path,
        ]);

        $guruUser = $siswa->guru?->user;
        if ($guruUser) {
            $guruUser->notify(new PengajuanIzinNotification(
                'Pengajuan izin baru',
                $siswa->nama_lengkap . ' mengajukan izin dan menunggu persetujuan.',
                route('guru.izin.show', $pengajuan->id)
            ));
        }

        return redirect()->route('siswa.izin.index')->with('success', 'Pengajuan izin berhasil dikirim kepada Guru Pembimbing.');
    }

    public function surat(Request $request, PengajuanIzin $izin)
    {
        $siswa = Siswa::where('user_id', $request->user()->id)->firstOrFail();
        abort_unless((int) $izin->siswa_id === (int) $siswa->id, 404);
        abort_unless(Storage::disk('public')->exists($izin->surat_path), 404);

        return Storage::disk('public')->response($izin->surat_path);
    }
}
