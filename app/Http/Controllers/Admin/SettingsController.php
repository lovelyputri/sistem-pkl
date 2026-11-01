<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.settings', ['admin' => $request->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $admin = $request->user();
        $validated = $request->validate([
            'nama_akun' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($admin->id)],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'current_password' => ['required', 'current_password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'nama_akun.required' => 'Nama akun admin wajib diisi.',
            'current_password.required' => 'Masukkan password saat ini untuk menyimpan perubahan.',
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $fotoLama = $admin->foto_profil;
        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('foto-profil/admin', 'public');
        }

        $admin->nama_akun = $validated['nama_akun'];
        $admin->email = $validated['email'];
        if (!empty($validated['foto_profil'])) $admin->foto_profil = $validated['foto_profil'];
        if (!empty($validated['password'])) $admin->password = Hash::make($validated['password']);
        $admin->save();

        if (!empty($validated['foto_profil']) && $fotoLama) Storage::disk('public')->delete($fotoLama);

        return redirect()->route('admin.settings.edit')->with('success', 'Profil dan pengaturan akun admin berhasil diperbarui.');
    }
}
