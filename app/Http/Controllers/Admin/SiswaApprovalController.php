<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiswaApprovalController extends Controller
{
    /**
     * Menampilkan pendaftaran siswa yang menunggu keputusan Admin.
     */
    public function index(): View
    {
        $pendaftar = User::query()
            ->where('role', 'siswa')
            ->where('status', 'pending')
            ->with(['siswa.sekolah', 'siswa.jurusan', 'siswa.kelas'])
            ->latest()
            ->paginate(10);

        $totalPending = User::query()
            ->where('role', 'siswa')
            ->where('status', 'pending')
            ->count();

        return view('admin.siswa.approval.index', compact(
            'pendaftar',
            'totalPending'
        ));
    }

    /**
     * Menyetujui pendaftaran siswa.
     */
    public function approve(User $user): RedirectResponse
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        if ($user->status !== 'pending') {
            return redirect()
                ->route('admin.siswa.approval.index')
                ->with('info', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $user->update(['status' => 'approved']);

        return redirect()
            ->route('admin.siswa.approval.index')
            ->with('success', 'Pendaftaran siswa berhasil disetujui.');
    }

    /**
     * Menolak pendaftaran siswa.
     */
    public function reject(User $user): RedirectResponse
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        if ($user->status !== 'pending') {
            return redirect()
                ->route('admin.siswa.approval.index')
                ->with('info', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $user->update(['status' => 'rejected']);

        return redirect()
            ->route('admin.siswa.approval.index')
            ->with('success', 'Pendaftaran siswa berhasil ditolak.');
    }
}
