<?php

namespace App\Helpers\Siswa;

use App\Helpers\PaginateHelper;
use Illuminate\Http\Request;

class NotifikasiHelper
{
    public static function getDataIndex(Request $request): array
    {
        $query = $request->user()->notifications()->getQuery()->latest();
        $filter = $request->string('status')->toString();
        if ($filter === 'belum_dibaca') $query->whereNull('read_at');
        if ($filter === 'sudah_dibaca') $query->whereNotNull('read_at');

        return [
            'notifikasis' => PaginateHelper::paginate($query, 15),
            'jumlahBelumDibaca' => $request->user()->unreadNotifications()->count(),
            'filter' => $filter,
        ];
    }
}
