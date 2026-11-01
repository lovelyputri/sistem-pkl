<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\JurnalHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JurnalController extends Controller
{
    public function index(Request $request): View
    {
        return view('guru.jurnal.index', JurnalHelper::getDataIndex($request));
    }
}
