<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JurnalController extends Controller
{
    private function siswa(): Siswa
    {
        return Siswa::where('user_id', auth()->id())->firstOrFail();
    }

    public function index(): View
    {
        $siswa = $this->siswa();
        $jurnals = Jurnal::where('siswa_id', $siswa->id)->latest('tanggal')->latest('id')->paginate(10);

        return view('siswa.jurnal.index', compact('siswa', 'jurnals'));
    }

    public function create(): View
    {
        return view('siswa.jurnal.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'kegiatan' => ['required', 'string', 'max:10000'],
            'keterangan' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $siswa = $this->siswa();
        $data = collect($validated)->except('image')->all();
        $data['siswa_id'] = $siswa->id;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('jurnal', 'public');
        }

        Jurnal::create($data);

        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal harian berhasil ditambahkan.');
    }

    public function edit(Jurnal $jurnal): View|RedirectResponse
    {
        abort_unless($jurnal->siswa_id === $this->siswa()->id, 403);
        return view('siswa.jurnal.edit', compact('jurnal'));
    }

    public function update(Request $request, Jurnal $jurnal): RedirectResponse
    {
        abort_unless($jurnal->siswa_id === $this->siswa()->id, 403);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'kegiatan' => ['required', 'string', 'max:10000'],
            'keterangan' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = collect($validated)->except('image')->all();
        if ($request->hasFile('image')) {
            if ($jurnal->image) Storage::disk('public')->delete($jurnal->image);
            $data['image'] = $request->file('image')->store('jurnal', 'public');
        }

        $jurnal->update($data);

        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal harian berhasil diperbarui.');
    }

    public function destroy(Jurnal $jurnal): RedirectResponse
    {
        abort_unless($jurnal->siswa_id === $this->siswa()->id, 403);
        if ($jurnal->image) Storage::disk('public')->delete($jurnal->image);
        $jurnal->delete();

        return redirect()->route('siswa.jurnal.index')->with('success', 'Jurnal harian berhasil dihapus.');
    }
}
