<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\MonitoringAbsensiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringAbsensiController extends Controller
{
    public function index(Request $request): View
    {
        return view('guru.absensi.index', MonitoringAbsensiHelper::getDataIndex($request));
    }
}
