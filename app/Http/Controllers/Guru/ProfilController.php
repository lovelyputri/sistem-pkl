<?php

namespace App\Http\Controllers\Guru;

use App\Helpers\Guru\ProfilHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
