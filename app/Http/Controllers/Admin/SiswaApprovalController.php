<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaApprovalController extends Controller
{
    public function index(Request $request): View
    {
        $cari = trim((string) $request->query('cari', ''));
        $status = $request->query('status', '');

        if (! in_array($status, ['', 'pending', 'approved', 'rejected'], true)) {
            $status = '';
        }

        $pendaftar = User::query()
            ->where('role', 'siswa')
            ->with('siswa.sekolah')
            ->when($status !== '', fn ($query) => $query->where('status', $status))
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
