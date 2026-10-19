<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function edit(): View
    {
        $siswa = Siswa::with(['user', 'sekolah', 'jurusan', 'kelas', 'guru.user'])
            ->where('user_id', auth()->id())->firstOrFail();

        return view('siswa.profil', compact('siswa'));
    }

    public function update(Request $request): RedirectResponse
    {
        $siswa = Siswa::where('user_id', auth()->id())->firstOrFail();
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(auth()->id())],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date', 'before:today'],
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'no_telepon' => ['nullable', 'string', 'max:25'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update(['email' => $validated['email']]);
        $siswa->update(collect($validated)->only([
            'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_telepon'
        ])->all());

        if (!empty($validated['password'])) {
            auth()->user()->update(['password' => Hash::make($validated['password'])]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
