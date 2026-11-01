<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Jurnal;
use App\Models\Siswa;
use App\Notifications\GuruReminderNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PengingatController extends Controller
{
    public function store(Request $request, Siswa $siswa): RedirectResponse
    {
        $validated = $request->validate([
            'jenis' => ['required', 'in:absensi,jurnal'],
        ]);

        $guru = Guru::where('user_id', $request->user()->id)->firstOrFail();

        // Guru hanya boleh mengirim pengingat kepada siswa bimbingannya sendiri.
        abort_unless((int) $siswa->guru_id === (int) $guru->id, 404);

        $sudahMengisi = $validated['jenis'] === 'absensi'
            ? Absensi::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->exists()
            : Jurnal::where('siswa_id', $siswa->id)->whereDate('tanggal', today())->exists();

        if ($sudahMengisi) {
            return back()->with('error', 'Siswa tersebut sudah menyelesaikan pengisian hari ini.');
        }

        if (!$siswa->user) {
            return back()->with('error', 'Akun pengguna siswa tidak ditemukan.');
        }

        // Cegah pengiriman pengingat yang sama berulang kali pada tanggal yang sama.
        $sudahDiingatkan = $siswa->user->notifications()
            ->where('data->reminder_type', $validated['jenis'])
            ->where('data->reminder_date', today()->toDateString())
            ->exists();

        if ($sudahDiingatkan) {
            return back()->with('error', 'Pengingat untuk siswa ini sudah pernah dikirim hari ini.');
        }

        $siswa->user->notify(new GuruReminderNotification(
            $validated['jenis'],
            $guru->nama_lengkap ?? $request->user()->email,
            today()->toDateString()
        ));

        return back()->with('success', 'Pengingat berhasil dikirim kepada ' . $siswa->nama_lengkap . '.');
    }
}
