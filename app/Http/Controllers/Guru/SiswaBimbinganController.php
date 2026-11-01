<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\SiswaBimbinganHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaBimbinganController extends Controller
{
    public function index(Request $request): View
    {
        return view('guru.siswa.index', SiswaBimbinganHelper::getDataIndex($request));
    }
}
