<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\SekolahJurusanHelper;
use App\Models\Jurusan;
use App\Models\Sekolah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SekolahJurusanController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.sekolah-jurusan.index', SekolahJurusanHelper::getDataIndex($request));
    }

    public function storeSekolah(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255', 'unique:sekolahs,nama_sekolah'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos/sekolah', 'public');
        }

        Sekolah::create($data);

        return redirect()->route('admin.sekolah-jurusan.index', ['bagian' => 'sekolah'])
            ->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    public function updateSekolah(Request $request, Sekolah $sekolah): RedirectResponse
    {
        $data = $request->validate([
            'nama_sekolah' => ['required', 'string', 'max:255', Rule::unique('sekolahs', 'nama_sekolah')->ignore($sekolah->id)],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        unset($data['logo']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos/sekolah', 'public');

            if ($sekolah->logo) {
                Storage::disk('public')->delete($sekolah->logo);
            }
        }

        $sekolah->update($data);

        return redirect()->route('admin.sekolah-jurusan.index', ['bagian' => 'sekolah'])
            ->with('success', 'Data sekolah berhasil diperbarui.');
    }

    public function destroySekolah(Sekolah $sekolah): RedirectResponse
    {
        if ($sekolah->siswas()->exists() || $sekolah->gurus()->exists()) {
            return back()->with('error', 'Sekolah tidak bisa dihapus karena masih digunakan oleh data siswa atau guru. Ubah data terkait terlebih dahulu.');
        }

        if ($sekolah->logo) {
            Storage::disk('public')->delete($sekolah->logo);
        }

        $sekolah->delete();

        return redirect()->route('admin.sekolah-jurusan.index', ['bagian' => 'sekolah'])
            ->with('success', 'Data sekolah berhasil dihapus.');
    }

    public function storeJurusan(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_jurusan' => ['required', 'string', 'max:255', 'unique:jurusans,nama_jurusan'],
        ]);
        Jurusan::create($data);

        return redirect()->route('admin.sekolah-jurusan.index', ['bagian' => 'jurusan'])
            ->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function updateJurusan(Request $request, Jurusan $jurusan): RedirectResponse
    {
        $data = $request->validate([
            'nama_jurusan' => ['required', 'string', 'max:255', Rule::unique('jurusans', 'nama_jurusan')->ignore($jurusan->id)],
        ]);
        $jurusan->update($data);

        return redirect()->route('admin.sekolah-jurusan.index', ['bagian' => 'jurusan'])
            ->with('success', 'Data jurusan berhasil diperbarui.');
    }

    public function destroyJurusan(Jurusan $jurusan): RedirectResponse
    {
        if ($jurusan->siswas()->exists()) {
            return back()->with('error', 'Jurusan tidak bisa dihapus karena masih digunakan oleh data siswa.');
        }
        $jurusan->delete();

        return redirect()->route('admin.sekolah-jurusan.index', ['bagian' => 'jurusan'])
            ->with('success', 'Data jurusan berhasil dihapus.');
    }
}
