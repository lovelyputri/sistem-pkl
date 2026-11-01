<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\DashboardHelper;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan ringkasan dashboard Admin.
     */
    public function index()
    {
        return view('dashboard.admin', DashboardHelper::getSummary());
    }

}
