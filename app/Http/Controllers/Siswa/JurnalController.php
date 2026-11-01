<?php

namespace App\Http\Controllers\Siswa;

use App\Helpers\Siswa\JurnalHelper;
use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JurnalController extends Controller
{
    public function index(Request $request): View
    {
        return view('siswa.jurnal.index', JurnalHelper::getDataIndex($request));
    }

    public function create(): View
    {
        $siswa = Siswa::where('user_id', auth()->id())->firstOrFail();
        return view('siswa.jurnal.create', compact('siswa'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'kegiatan' => ['required', 'string', 'min:200', 'max:10000'],
            'keterangan' => ['nullable', 'string', 'max:2000'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ], [
            'tanggal.before_or_equal' => 'Tanggal jurnal tidak boleh melebihi hari ini.',
            'kegiatan.min' => 'Deskripsi kegiatan minimal 200 karakter.',
            'image.required' => 'Foto kegiatan wajib diunggah.',
            'image.max' => 'Ukuran foto maksimal 4 MB.',
        ]);

        $siswa = Siswa::where('user_id', $request->user()->id)->firstOrFail();
        if (Jurnal::where('siswa_id', $siswa->id)->whereDate('tanggal', $data['tanggal'])->exists()) {
            return back()->withInput()->withErrors(['tanggal' => 'Jurnal untuk tanggal tersebut sudah pernah dibuat.']);
        }

        $path = $request->file('image')->store('jurnal/siswa-' . $siswa->id, 'public');
        try {
            DB::transaction(function () use ($siswa, $data, $path) {
                Jurnal::create([
                    'siswa_id' => $siswa->id,
                    'judul' => $data['judul'],
                    'tanggal' => $data['tanggal'],
                    'kegiatan' => $data['kegiatan'],
                    'keterangan' => $data['keterangan'] ?? null,
                    'image' => $path,
                ]);
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($path);
            throw $exception;
        }

        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal berhasil dikirim.');
    }

    public function show(Jurnal $jurnal): View
    {
        abort_unless($jurnal->siswa_id === Siswa::where('user_id', auth()->id())->value('id'), 404);
        return view('siswa.jurnal.show', compact('jurnal'));
    }

    public function edit(Jurnal $jurnal): View
    {
        abort_unless($jurnal->siswa_id === Siswa::where('user_id', auth()->id())->value('id'), 404);
        return view('siswa.jurnal.edit', compact('jurnal'));
    }

    public function update(Request $request, Jurnal $jurnal): RedirectResponse
    {
        abort_unless($jurnal->siswa_id === Siswa::where('user_id', $request->user()->id)->value('id'), 404);
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'kegiatan' => ['required', 'string', 'min:200', 'max:10000'],
            'keterangan' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ], ['kegiatan.min' => 'Deskripsi kegiatan minimal 200 karakter.']);

        $duplikat = Jurnal::where('siswa_id', $jurnal->siswa_id)->whereDate('tanggal', $data['tanggal'])->where('id', '!=', $jurnal->id)->exists();
        if ($duplikat) return back()->withInput()->withErrors(['tanggal' => 'Jurnal untuk tanggal tersebut sudah tersedia.']);

        $fotoLama = $jurnal->image;
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('jurnal/siswa-' . $jurnal->siswa_id, 'public');
        DB::transaction(fn () => $jurnal->update($data));
        if (!empty($data['image']) && $fotoLama) Storage::disk('public')->delete($fotoLama);

        return redirect()->route('siswa.jurnal.show', $jurnal)->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function destroy(Request $request, Jurnal $jurnal): RedirectResponse
    {
        abort_unless($jurnal->siswa_id === Siswa::where('user_id', $request->user()->id)->value('id'), 404);
        $foto = $jurnal->image;
        $jurnal->delete();
        if ($foto) Storage::disk('public')->delete($foto);
        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal berhasil dihapus.');
    }
}
