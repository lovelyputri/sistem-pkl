<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaBimbinganController extends Controller
{
    public function index(Request $request): View
    {
        $guru = Guru::where('user_id', auth()->id())->firstOrFail();
        $query = Siswa::with(['sekolah', 'kelas', 'jurusan', 'user'])->where('guru_id', $guru->id);
        if ($request->filled('cari')) {
            $cari = $request->string('cari')->toString();
            $query->where(fn ($q) => $q->where('nama_lengkap', 'like', "%{$cari}%")->orWhere('nisn', 'like', "%{$cari}%"));
        }
        return view('guru.siswa.index', ['guru' => $guru, 'siswas' => $query->orderBy('nama_lengkap')->paginate(15)->withQueryString()]);
    }
}
