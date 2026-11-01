<?php

namespace App\Helpers\Admin;

use App\Helpers\PaginateHelper;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;

class GuruHelper
{
    public static function getDataIndex(Request $request): array
    {
        $cari = trim((string) $request->query('cari', ''));
        $sekolahId = $request->query('sekolah_id', '');

        $query = Guru::query()
            ->with(['user', 'sekolah'])
            ->withCount('siswas')
            ->when($sekolahId !== '' && ctype_digit((string) $sekolahId), fn ($q) => $q->where('sekolah_id', $sekolahId))
            ->when($cari !== '', function ($q) use ($cari) {
                $q->where(function ($subQuery) use ($cari) {
                    $subQuery->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nip', 'like', "%{$cari}%")
                        ->orWhereHas('user', fn ($userQuery) => $userQuery->where('email', 'like', "%{$cari}%"));
                });
            })
            ->latest();

        return [
            'gurus' => PaginateHelper::paginate($query, 10),
            'cari' => $cari,
            'sekolahId' => $sekolahId,
            'sekolahs' => Sekolah::orderBy('nama_sekolah')->get(),
        ];
    }

    public static function getFormOptions(): array
    {
        return ['sekolahs' => Sekolah::orderBy('nama_sekolah')->get()];
    }

    public static function getDataShow(Guru $guru): array
    {
        $guru->load([
            'user',
            'sekolah',
            'siswas' => fn ($q) => $q->where(function ($query) {
                $query->whereNull('tanggal_selesai_pkl')->orWhereDate('tanggal_selesai_pkl', '>=', today());
            })->with(['user', 'kelas', 'jurusan'])->orderBy('nama_lengkap'),
        ]);

        $calonSiswa = Siswa::with(['user', 'kelas', 'jurusan'])
            ->where('sekolah_id', $guru->sekolah_id)
            ->where(function ($query) {
                $query->whereNull('tanggal_selesai_pkl')->orWhereDate('tanggal_selesai_pkl', '>=', today());
            })
            ->orderByRaw('CASE WHEN guru_id IS NOT NULL AND guru_id != ? THEN 1 ELSE 0 END', [$guru->id])
            ->orderBy('nama_lengkap')
            ->get();

        return compact('guru', 'calonSiswa');
    }
}
