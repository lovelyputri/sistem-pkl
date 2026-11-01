<?php

namespace App\Helpers\Guru;

use App\Models\Guru;

class ProfilHelper
{
    public static function getData(): array
    {
        return [
            'guru' => Guru::with(['user', 'sekolah'])
                ->where('user_id', auth()->id())
                ->firstOrFail(),
        ];
    }
}
