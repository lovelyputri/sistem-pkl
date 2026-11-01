<?php

namespace App\Helpers\Siswa;

use App\Models\Siswa;

class ProfilHelper
{
    public static function getData(): array
    {
        return [
            'siswa' => Siswa::with(['user','guru.sekolah','sekolah','jurusan','kelas'])
                ->where('user_id', auth()->id())->firstOrFail(),
        ];
    }
}
