<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\GuruHelper;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.guru.index', GuruHelper::getDataIndex($request));
    }

    public function create(): View
    {
        return view('admin.guru.create', GuruHelper::getFormOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nip' => ['nullable', 'string', 'max:50', 'unique:gurus,nip'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'sekolah_id' => ['required', 'exists:sekolahs,id'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('foto-profil/guru', 'public');
        }

        try {
            $guru = DB::transaction(function () use ($data) {
                $user = User::create([
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => 'guru',
                    'status' => 'approved',
                ]);

                return Guru::create([
                    'user_id' => $user->id,
                    'sekolah_id' => $data['sekolah_id'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'foto_profil' => $data['foto_profil'] ?? null,
                    'nip' => $data['nip'] ?: null,
                    'no_telepon' => $data['no_telepon'] ?: null,
                ]);
            });
        } catch (\Throwable $exception) {
            if (!empty($data['foto_profil'])) Storage::disk('public')->delete($data['foto_profil']);
            throw $exception;
        }

        return redirect()->route('admin.guru.show', $guru)->with('success', 'Guru pembimbing berhasil ditambahkan.');
    }

    public function show(Guru $guru): View
    {
        return view('admin.guru.show', GuruHelper::getDataShow($guru));
    }

    public function edit(Guru $guru): View
    {
        $guru->load('user');

        return view('admin.guru.edit', array_merge(
            ['guru' => $guru],
            GuruHelper::getFormOptions()
        ));
    }

    public function update(Request $request, Guru $guru): RedirectResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($guru->user_id)],
            'nip' => ['nullable', 'string', 'max:50', Rule::unique('gurus', 'nip')->ignore($guru->id)],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'sekolah_id' => ['required', 'exists:sekolahs,id'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $fotoLama = $guru->foto_profil;
        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('foto-profil/guru', 'public');
        }

        try {
            DB::transaction(function () use ($data, $guru) {
                if ((string) $guru->sekolah_id !== (string) $data['sekolah_id']) {
                    $guru->siswas()->update(['guru_id' => null]);
                }
                $guru->update([
                    'nama_lengkap' => $data['nama_lengkap'],
                    'nip' => $data['nip'] ?: null,
                    'no_telepon' => $data['no_telepon'] ?: null,
                    'sekolah_id' => $data['sekolah_id'],
                    'foto_profil' => $data['foto_profil'] ?? $guru->foto_profil,
                ]);
                $guru->user()->update(['email' => $data['email']]);
            });
        } catch (\Throwable $exception) {
            if (!empty($data['foto_profil']) && $data['foto_profil'] !== $fotoLama) Storage::disk('public')->delete($data['foto_profil']);
            throw $exception;
        }

        if (!empty($data['foto_profil']) && $fotoLama) Storage::disk('public')->delete($fotoLama);

        return redirect()->route('admin.guru.show', $guru)->with('success', 'Data guru pembimbing berhasil diperbarui.');
    }

    public function assignStudents(Request $request, Guru $guru): RedirectResponse
    {
        $data = $request->validate([
            'siswa_ids' => ['nullable', 'array'],
            'siswa_ids.*' => ['integer', 'distinct', 'exists:siswas,id'],
        ]);
        $ids = $data['siswa_ids'] ?? [];
        $students = Siswa::whereIn('id', $ids)->get();

        if ($students->contains(fn ($s) => (string) $s->sekolah_id !== (string) $guru->sekolah_id)) {
            return back()->withErrors(['siswa_ids' => 'Siswa yang ditugaskan harus berasal dari sekolah yang sama.'])->withInput();
        }
        if ($students->contains(fn ($s) => $s->guru_id && (int) $s->guru_id !== (int) $guru->id)) {
            return back()->withErrors(['siswa_ids' => 'Ada siswa yang sudah ditugaskan ke guru lain. Lepaskan penugasan sebelumnya terlebih dahulu.'])->withInput();
        }

        DB::transaction(function () use ($guru, $ids) {
            $guru->siswas()->update(['guru_id' => null]);
            if ($ids !== []) {
                Siswa::whereIn('id', $ids)
                    ->where('sekolah_id', $guru->sekolah_id)
                    ->where(function ($query) {
                        $query->whereNull('tanggal_selesai_pkl')
                            ->orWhereDate('tanggal_selesai_pkl', '>=', today());
                    })
                    ->whereNull('guru_id')
                    ->update(['guru_id' => $guru->id]);
            }
        });

        return redirect()->route('admin.guru.show', $guru)->with('success', 'Penugasan siswa aktif berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        DB::transaction(function () use ($guru) {
            $guru->siswas()->update(['guru_id' => null]);
            $user = $guru->user;
            if ($user) $user->delete();
            else $guru->delete();
        });

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus dan penugasan siswanya dilepas.');
    }
}
