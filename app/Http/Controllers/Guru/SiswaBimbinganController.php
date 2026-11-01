<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\SiswaBimbinganHelper;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaBimbinganController extends Controller
{
    public function index(Request $request): View
    {
        return view('guru.siswa.index', SiswaBimbinganHelper::getDataIndex($request));
    }

    public function show(Request $request, Siswa $siswa): View
    {
        return view('guru.siswa.show', SiswaBimbinganHelper::getDataShow($siswa, $request));
    }
}
