<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        $cari = trim((string) $request->query('cari', ''));
        $status = $request->query('status', '');
        $sekolahId = $request->query('sekolah_id', '');

        if (! in_array($status, ['', 'pending', 'approved', 'rejected'], true)) {
            $status = '';
        }

        $siswa = Siswa::query()
            ->with(['user', 'sekolah', 'jurusan', 'kelas', 'guru'])
            ->when($status !== '', fn ($query) => $query->whereHas('user', fn ($userQuery) => $userQuery->where('status', $status)))
            ->when($sekolahId !== '' && ctype_digit((string) $sekolahId), fn ($query) => $query->where('sekolah_id', $sekolahId))
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where(function ($subQuery) use ($cari) {
                    $subQuery->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nisn', 'like', "%{$cari}%")
                        ->orWhereHas('user', fn ($userQuery) => $userQuery->where('email', 'like', "%{$cari}%"));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();

        return view('admin.siswa.index', compact('siswa', 'cari', 'status', 'sekolahId', 'sekolahs'));
    }

    public function show(Siswa $siswa): View
    {
        $siswa->load(['user', 'sekolah', 'jurusan', 'kelas', 'guru']);

        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa): View
    {
        $siswa->load('user');

        return view('admin.siswa.edit', [
            'siswa' => $siswa,
            'sekolahs' => Sekolah::orderBy('nama_sekolah')->get(),
            'jurusans' => Jurusan::orderBy('nama_jurusan')->get(),
            'kelases' => Kelas::orderBy('nama_kelas')->get(),
            'gurus' => Guru::orderBy('nama_lengkap')->get(),
        ]);
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($siswa->user_id)],
            'nisn' => ['required', 'string', 'max:30', Rule::unique('siswas', 'nisn')->ignore($siswa->id)],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'sekolah_id' => ['required', 'exists:sekolahs,id'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'guru_id' => ['nullable', 'exists:gurus,id'],
            'tanggal_mulai_pkl' => ['nullable', 'date'],
            'tanggal_selesai_pkl' => ['nullable', 'date', 'after_or_equal:tanggal_mulai_pkl'],
        ], [
            'email.unique' => 'Email sudah digunakan akun lain.',
            'nisn.unique' => 'NISN sudah digunakan siswa lain.',
            'tanggal_selesai_pkl.after_or_equal' => 'Tanggal selesai PKL tidak boleh sebelum tanggal mulai.',
        ]);

        $siswa->update(collect($data)->except(['email'])->all());
        $siswa->user()->update(['email' => $data['email']]);

        return redirect()->route('admin.siswa.show', $siswa)->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $user = $siswa->user;
        if ($user) {
            // Menghapus akun juga menghapus data jurnal dan absensi yang terkait melalui foreign key cascade.
            $user->delete();
        } else {
            $siswa->delete();
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
