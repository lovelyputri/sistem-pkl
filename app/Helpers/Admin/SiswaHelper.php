<?php

namespace App\Helpers\Admin;

use App\Helpers\PaginateHelper;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaHelper
{
    public static function getDataIndex(Request $request): array
    {
        $cari = trim((string) $request->query('cari', ''));
        $status = $request->query('status', '');
        $sekolahId = $request->query('sekolah_id', '');

        if (! in_array($status, ['', 'pending', 'approved', 'rejected'], true)) {
            $status = '';
        }

        $query = Siswa::query()
            ->with(['user', 'sekolah', 'jurusan', 'kelas', 'guru'])
            ->when($status !== '', fn ($q) => $q->whereHas('user', fn ($userQuery) => $userQuery->where('status', $status)))
            ->when($sekolahId !== '' && ctype_digit((string) $sekolahId), fn ($q) => $q->where('sekolah_id', $sekolahId))
            ->when($cari !== '', function ($q) use ($cari) {
                $q->where(function ($subQuery) use ($cari) {
                    $subQuery->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nisn', 'like', "%{$cari}%")
                        ->orWhereHas('user', fn ($userQuery) => $userQuery->where('email', 'like', "%{$cari}%"));
                });
            })
            ->latest();

        return [
            'siswa' => PaginateHelper::paginate($query, 10),
            'cari' => $cari,
            'status' => $status,
            'sekolahId' => $sekolahId,
            'sekolahs' => Sekolah::orderBy('nama_sekolah')->get(),
        ];
    }

    public static function getFormOptions(): array
    {
        return [
            'sekolahs' => Sekolah::orderBy('nama_sekolah')->get(),
            'jurusans' => Jurusan::orderBy('nama_jurusan')->get(),
            'kelases' => Kelas::orderBy('nama_kelas')->get(),
            'gurus' => Guru::orderBy('nama_lengkap')->get(),
        ];
    }
}
