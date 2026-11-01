<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\MonitoringHelper;
use App\Models\Absensi;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function absensi(Request $request): View
    {
        return view('admin.monitoring.absensi', MonitoringHelper::getDataAbsensi($request));
    }

    public function riwayatAbsensi(Request $request): View
    {
        return $this->absensi($request);
    }

    public function jurnal(Request $request): View
    {
        return view('admin.monitoring.jurnal', MonitoringHelper::getDataJurnal($request));
    }

}
