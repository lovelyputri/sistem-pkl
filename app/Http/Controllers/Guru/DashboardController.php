<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\DashboardHelper;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('guru.dashboard', DashboardHelper::getData());
    }
}
