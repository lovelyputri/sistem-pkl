<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaApprovalController extends Controller
{
    /**
     * Menampilkan seluruh pendaftaran siswa dalam satu tabel.
     */
    public function index(Request $request): View
    {
        $pendaftar = User::query()
            ->where('role', 'siswa')
            ->with(['siswa.sekolah', 'siswa.jurusan', 'siswa.kelas'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.siswa.approval.index', compact('pendaftar'));
    }

    public function approve(User $user): RedirectResponse
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        if ($user->status !== 'pending') {
            return redirect()->route('admin.siswa.approval.index')
                ->with('info', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $user->update(['status' => 'approved']);

        return redirect()->route('admin.siswa.approval.index')
            ->with('success', 'Pendaftaran siswa berhasil disetujui.');
    }

    public function reject(User $user): RedirectResponse
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        if ($user->status !== 'pending') {
            return redirect()->route('admin.siswa.approval.index')
                ->with('info', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $user->update(['status' => 'rejected']);

        return redirect()->route('admin.siswa.approval.index')
            ->with('success', 'Pendaftaran siswa berhasil ditolak.');
    }
}
