<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\MonitoringHelper;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function absensi(Request $request): View
    {
        return view('admin.monitoring.absensi', MonitoringHelper::getDataAbsensi($request));
    }

    public function jurnal(Request $request): View
    {
        return view('admin.monitoring.jurnal', MonitoringHelper::getDataJurnal($request));
    }

}
