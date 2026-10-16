<?php

namespace App\\Http\\Controllers\\Guru;

use App\\Http\\Controllers\\Controller;
use App\\Models\\Guru;
use Illuminate\\View\\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        $guru = Guru::with(['user', 'sekolah'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('guru.profil', [
            'guru' => $guru,
        ]);
    }
}
