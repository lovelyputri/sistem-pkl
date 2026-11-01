<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\ProfilHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        return view('guru.profil', ProfilHelper::getData());
    }

    public function update(Request $request): RedirectResponse
    {
        $guru = ProfilHelper::getData()['guru'];

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($guru->user_id),
            ],
            'nip' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('gurus', 'nip')->ignore($guru->id),
            ],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $fotoLama = $guru->foto_profil;

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('foto-profil/guru', 'public');
        }

        DB::transaction(function () use ($guru, $data) {
            $guru->update([
                'nama_lengkap' => $data['nama_lengkap'],
                'nip' => $data['nip'] ?: null,
                'no_telepon' => $data['no_telepon'] ?: null,
                'foto_profil' => $data['foto_profil'] ?? $guru->foto_profil,
            ]);

            $guru->user()->update([
                'email' => $data['email'],
            ]);
        });

        if (! empty($data['foto_profil']) && $fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()
            ->route('guru.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $data = $request->validateWithBag('passwordUpdate', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ], [
            'current_password.current_password' => 'Password lama yang dimasukkan tidak sesuai.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak sama.',
            'password.different' => 'Password baru harus berbeda dari password lama.',
        ]);

        $request->user()->forceFill([
            'password' => Hash::make($data['password']),
        ])->save();

        return redirect()
            ->route('guru.profil')
            ->with('password_success', 'Password berhasil diperbarui.');
    }
}
