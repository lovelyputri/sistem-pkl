<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\ProfilHelper;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        return view('guru.profil', ProfilHelper::getData());
    }
}
