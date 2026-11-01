<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\SiswaApprovalHelper;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaApprovalController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.siswa.approval.index', SiswaApprovalHelper::getDataIndex($request));
    }

    public function show(User $user): View
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        $user->load('siswa.sekolah', 'siswa.jurusan', 'siswa.kelas');

        return view('admin.siswa.approval.show', compact('user'));
    }

    public function approve(User $user): RedirectResponse
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        if ($user->status !== 'pending') {
            return back()->with('info', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $user->update([
            'status' => 'approved',
            'alasan_penolakan' => null,
        ]);

        return back()->with('success', 'Pendaftaran siswa berhasil disetujui.');
    }

    public function reject(Request $request, User $user): RedirectResponse
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        if ($user->status !== 'pending') {
            return back()->with('info', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $data = $request->validate([
            'alasan_penolakan' => ['required', 'string', 'min:5', 'max:1000'],
        ], [
            'alasan_penolakan.required' => 'Alasan penolakan wajib diisi.',
            'alasan_penolakan.min' => 'Alasan penolakan minimal 5 karakter.',
            'alasan_penolakan.max' => 'Alasan penolakan maksimal 1000 karakter.',
        ]);

        $user->update([
            'status' => 'rejected',
            'alasan_penolakan' => $data['alasan_penolakan'],
        ]);

        return redirect()->route('admin.siswa.approval.index')
            ->with('success', 'Pendaftaran siswa berhasil ditolak.');
    }
}
