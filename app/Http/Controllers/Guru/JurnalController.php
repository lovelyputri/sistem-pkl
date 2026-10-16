<?php

namespace App\\Http\\Controllers\\Guru;

use App\\Http\\Controllers\\Controller;
use App\\Models\\Guru;
use App\\Models\\Jurnal;
use App\\Models\\Siswa;
use Illuminate\\Http\\Request;
use Illuminate\\View\\View;

class JurnalController extends Controller
{
    public function index(Request $request): View
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();

        $siswaIds = Siswa::where('guru_id', $guru->id)->select('id');

        $query = Jurnal::with('siswa')->whereIn('siswa_id', $siswaIds);

        if ($request->filled('cari')) {
            $cari = $request->string('cari')->toString();

            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                    ->orWhereHas('siswa', function ($siswaQuery) use ($cari) {
                        $siswaQuery->where('nama_lengkap', 'like', "%{$cari}%");
                    });
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->date('tanggal'));
        }

        $jurnals = $query->latest('tanggal')
            ->paginate(15)
            ->withQueryString();

        return view('guru.jurnal.index', [
            'guru' => $guru,
            'jurnals' => $jurnals,
        ]);
    }
}
