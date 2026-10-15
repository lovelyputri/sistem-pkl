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
     * Menampilkan seluruh pendaftaran siswa dengan pencarian dan filter status.
     */
    public function index(Request $request): View
    {
        $cari = trim((string) $request->query('cari', ''));
        $status = $request->query('status', '');

        if (! in_array($status, ['', 'pending', 'approved', 'rejected'], true)) {
            $status = '';
        }

        $pendaftar = User::query()
            ->where('role', 'siswa')
            ->with(['siswa.sekolah', 'siswa.jurusan', 'siswa.kelas'])
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where(function ($subQuery) use ($cari) {
                    $subQuery->where('email', 'like', "%{$cari}%")
                        ->orWhereHas('siswa', function ($siswaQuery) use ($cari) {
                            $siswaQuery->where('nama_lengkap', 'like', "%{$cari}%")
                                ->orWhere('nisn', 'like', "%{$cari}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.siswa.approval.index', compact('pendaftar', 'cari', 'status'));
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
