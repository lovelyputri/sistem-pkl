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
     * Menampilkan pendaftaran siswa berdasarkan status.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'pending');

        if (! in_array($status, ['pending', 'approved', 'rejected'], true)) {
            $status = 'pending';
        }

        $pendaftar = User::query()
            ->where('role', 'siswa')
            ->where('status', $status)
            ->with(['siswa.sekolah', 'siswa.jurusan', 'siswa.kelas'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $jumlahStatus = User::query()
            ->where('role', 'siswa')
            ->selectRaw('status, COUNT(*) as total')
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->groupBy('status')
            ->pluck('total', 'status');

        $totalPending = $jumlahStatus->get('pending', 0);
        $totalApproved = $jumlahStatus->get('approved', 0);
        $totalRejected = $jumlahStatus->get('rejected', 0);

        return view('admin.siswa.approval.index', compact(
            'pendaftar',
            'status',
            'totalPending',
            'totalApproved',
            'totalRejected'
        ));
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
