<?php

namespace App\Http\Controllers\Siswa;

use App\Helpers\Siswa\NotifikasiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotifikasiController extends Controller
{
    public function index(Request $request): View
    {
        return view('siswa.notifikasi.index', NotifikasiHelper::getDataIndex($request));
    }

    public function read(Request $request, string $notification): RedirectResponse
    {
        $item = $request->user()->notifications()->whereKey($notification)->firstOrFail();
        $item->markAsRead();
        $url = $item->data['url'] ?? route('siswa.dashboard');
        return redirect()->to($url);
    }

    public function readAll(Request $request): RedirectResponse
    {
        $request->user()->unreadNotifications()->update(['read_at' => now()]);
        return back()->with('success','Semua notifikasi sudah ditandai dibaca.');
    }
}
