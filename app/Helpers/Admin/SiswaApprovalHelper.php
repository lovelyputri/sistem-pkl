<?php

namespace App\Helpers\Admin;

use App\Helpers\PaginateHelper;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaApprovalHelper
{
    public static function getDataIndex(Request $request): array
    {
        $cari = trim((string) $request->query('cari', ''));
        $status = $request->query('status', '');

        if (! in_array($status, ['', 'pending', 'approved', 'rejected'], true)) {
            $status = '';
        }

        $query = User::query()
            ->where('role', 'siswa')
            ->with('siswa.sekolah')
            ->when($status !== '', fn ($q) => $q->where('status', $status))
            ->when($cari !== '', function ($q) use ($cari) {
                $q->where(function ($subQuery) use ($cari) {
                    $subQuery->where('email', 'like', "%{$cari}%")
                        ->orWhereHas('siswa', function ($siswaQuery) use ($cari) {
                            $siswaQuery->where('nama_lengkap', 'like', "%{$cari}%")
                                ->orWhere('nisn', 'like', "%{$cari}%");
                        });
                });
            })
            ->latest();

        return [
            'pendaftar' => PaginateHelper::paginate($query, 10),
            'cari' => $cari,
            'status' => $status,
        ];
    }
}
