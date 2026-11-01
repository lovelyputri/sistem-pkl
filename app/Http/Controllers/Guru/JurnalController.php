<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\JurnalHelper;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JurnalController extends Controller
{
    public function index(Request $request): View
    {
        return view('guru.jurnal.index', JurnalHelper::getDataIndex($request));
    }

    public function show(Jurnal $jurnal): View
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        abort_unless((int) $jurnal->siswa?->guru_id === (int) $guru->id, 404);
        $jurnal->load('siswa.sekolah', 'siswa.jurusan', 'siswa.kelas');
        return view('guru.jurnal.show', compact('jurnal'));
    }
}
