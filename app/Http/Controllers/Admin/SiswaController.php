<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\SiswaHelper;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.siswa.index', SiswaHelper::getDataIndex($request));
    }

    public function create(): View
    {
        return view('admin.siswa.create', SiswaHelper::getFormOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nisn' => ['required', 'string', 'max:30', 'unique:siswas,nisn'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'no_telepon' => ['required', 'string', 'max:30'],
            'sekolah_id' => ['required', 'exists:sekolahs,id'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'guru_id' => ['nullable', Rule::exists('gurus', 'id')->where(fn ($query) => $query->where('sekolah_id', $request->input('sekolah_id')))],
            'tanggal_mulai_pkl' => ['nullable', 'date'],
            'tanggal_selesai_pkl' => ['nullable', 'date', 'after_or_equal:tanggal_mulai_pkl'],
        ], [
            'email.unique' => 'Email sudah digunakan akun lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'tanggal_selesai_pkl.after_or_equal' => 'Tanggal selesai PKL tidak boleh sebelum tanggal mulai.',
        ]);

        $siswa = DB::transaction(function () use ($data) {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'siswa',
                // Akun yang dibuat admin langsung aktif tanpa alur persetujuan pendaftaran.
                'status' => 'approved',
            ]);

            return Siswa::create([
                'user_id' => $user->id,
                'nama_lengkap' => $data['nama_lengkap'],
                'nisn' => $data['nisn'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'no_telepon' => $data['no_telepon'],
                'sekolah_id' => $data['sekolah_id'],
                'jurusan_id' => $data['jurusan_id'],
                'kelas_id' => $data['kelas_id'],
                'guru_id' => $data['guru_id'] ?: null,
                'tanggal_mulai_pkl' => $data['tanggal_mulai_pkl'] ?: null,
                'tanggal_selesai_pkl' => $data['tanggal_selesai_pkl'] ?: null,
            ]);
        });

        return redirect()->route('admin.siswa.show', $siswa)
            ->with('success', 'Siswa berhasil ditambahkan. Akun siswa sudah aktif dan dapat digunakan untuk login.');
    }

    public function show(Siswa $siswa): View
    {
        $siswa->load(['user', 'sekolah', 'jurusan', 'kelas', 'guru']);

        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa): View
    {
        $siswa->load('user');

        return view('admin.siswa.edit', array_merge(
            ['siswa' => $siswa],
            SiswaHelper::getFormOptions()
        ));
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
            // Menghapus akun juga menghapus jurnal dan absensi terkait melalui foreign key cascade.
            $user->delete();
        } else {
            $siswa->delete();
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
