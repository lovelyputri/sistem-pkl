@extends('layouts.admin')
@section('title', 'Profil Guru Pembimbing')
@section('page-heading', 'Profil Guru Pembimbing')
@push('styles')
<style>
.guru-profile-head{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;background:linear-gradient(120deg,#17357f,#315fc4);padding:24px;border-radius:14px;color:#fff}
.guru-profile-avatar{width:62px;height:62px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.17);font-size:24px;font-weight:700}
.guru-profile-card{margin-top:18px;background:#fff;border:1px solid #e5eaf2;border-radius:12px;padding:20px}
.guru-profile-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
.guru-profile-grid label{display:block;color:#94a3b8;font-size:11px;margin-bottom:7px}
.guru-profile-grid strong{font-size:13px;overflow-wrap:anywhere}
.student-options{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}
.student-option{display:flex;gap:10px;border:1px solid #e5eaf2;border-radius:9px;padding:12px;font-size:12px}
.student-option small{display:block;color:#64748b;margin-top:5px}
.student-option.is-assigned{background:#e5e7eb!important;border:1px solid #cbd5e1!important;color:#6b7280!important;cursor:not-allowed;opacity:.8}
.student-option.is-assigned small{color:#6b7280!important}
.student-option.is-assigned input{cursor:not-allowed;accent-color:#9ca3af;opacity:.65}
.student-option .assignment-status{display:inline-block;margin-top:5px;padding:3px 6px;border-radius:5px;background:#e5e7eb;color:#6b7280;font-size:10px;font-weight:600}
@media(max-width:650px){.guru-profile-grid,.student-options{grid-template-columns:1fr}.guru-profile-card{padding:15px}}
</style>
@endpush
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:20px"><div><h1>Profil Guru Pembimbing</h1><p class="admin-intro" style="margin-bottom:0">Kelola data guru dan siswa yang dibimbing.</p></div><a href="{{ route('admin.guru.index') }}" style="padding:10px 13px;border:1px solid #d7deea;border-radius:9px">← Daftar Guru</a></div>
@if(session('success'))<div style="padding:13px;background:#ecfdf5;color:#166534;border-radius:9px;margin-bottom:15px">{{ session('success') }}</div>@endif
@if($errors->any())<div style="padding:13px;background:#fff1f2;color:#9f1239;border-radius:9px;margin-bottom:15px"><strong>Penugasan belum disimpan:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="guru-profile-head"><div style="display:flex;align-items:center;gap:15px"><div class="guru-profile-avatar">{{ mb_strtoupper(mb_substr($guru->nama_lengkap,0,1)) }}</div><div><h1 style="font-size:21px;margin:0 0 7px">{{ $guru->nama_lengkap }}</h1><div style="font-size:12px;color:#dbe7ff">{{ $guru->sekolah?->nama_sekolah ?? 'Sekolah belum ditentukan' }}</div><div style="font-size:11px;color:#dbe7ff;margin-top:6px">{{ $guru->user?->email }}</div></div></div><div style="display:flex;gap:8px;flex-wrap:wrap"><a href="{{ route('admin.guru.edit',$guru) }}" style="padding:10px 13px;border-radius:8px;background:#fff;color:#17357f;font-size:12px;font-weight:650">Edit Profil</a><form method="POST" action="{{ route('admin.guru.destroy',$guru) }}" onsubmit="return confirm('Hapus akun guru? Siswa tetap tersimpan dan penugasannya akan dilepas.')">@csrf @method('DELETE')<button type="submit" style="padding:10px 13px;border-radius:8px;background:#9f2535;color:#fff;border:0;font-size:12px">Hapus Guru</button></form></div></div>
<div class="guru-profile-card"><h2 style="font-size:14px;margin:0 0 18px">Informasi Guru</h2><div class="guru-profile-grid"><div><label>Nama lengkap</label><strong>{{ $guru->nama_lengkap }}</strong></div><div><label>NIP</label><strong>{{ $guru->nip ?: '—' }}</strong></div><div><label>Nomor telepon</label><strong>{{ $guru->no_telepon ?: '—' }}</strong></div><div><label>Email login</label><strong>{{ $guru->user?->email ?: '—' }}</strong></div><div><label>Sekolah</label><strong>{{ $guru->sekolah?->nama_sekolah ?: 'Belum ditentukan' }}</strong></div><div><label>Jumlah siswa bimbingan</label><strong>{{ $guru->siswas->count() }} siswa</strong></div></div></div>
<div class="guru-profile-card"><div style="margin-bottom:15px"><h2 style="font-size:14px;margin:0 0 6px">Penugasan Siswa</h2><p style="font-size:12px;color:#64748b;margin:0">Pilih siswa yang berasal dari sekolah yang sama dengan guru ini. Siswa yang sudah ditugaskan ke guru lain ditampilkan abu-abu dan tidak bisa dipilih.</p></div>
@if(!$guru->sekolah_id)<p style="padding:12px;background:#fff7ed;color:#9a3412;border-radius:8px">Sekolah guru belum ditentukan. Edit profil guru terlebih dahulu.</p>
@elseif($calonSiswa->isEmpty())<p style="padding:18px;background:#f8fafc;color:#64748b;border-radius:8px">Belum ada siswa yang bisa ditugaskan dari sekolah ini.</p>
@else
<form method="POST" action="{{ route('admin.guru.assign-students',$guru) }}">@csrf @method('PUT')
<div style="display:flex;gap:9px;flex-wrap:wrap;margin-bottom:14px"><input id="studentSearch" type="search" placeholder="Cari nama atau NISN siswa..." style="flex:1;min-width:190px;padding:10px;border:1px solid #d7deea;border-radius:8px"><button type="button" id="selectVisible" style="padding:9px 11px;border:1px solid #d7deea;border-radius:8px;background:#fff">Pilih semua yang tampil</button></div>
<div class="student-options" id="studentOptions">@foreach($calonSiswa as $siswa)@php($ditugaskanKeGuruLain = $siswa->guru_id !== null && (int) $siswa->guru_id !== (int) $guru->id)<label class="student-option {{ $ditugaskanKeGuruLain ? 'is-assigned' : '' }}" data-search="{{ strtolower($siswa->nama_lengkap.' '.$siswa->nisn) }}"><input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" @checked(in_array($siswa->id, old('siswa_ids', $guru->siswas->pluck('id')->all()))) @disabled($ditugaskanKeGuruLain)><span><strong>{{ $siswa->nama_lengkap }}</strong><small>NISN: {{ $siswa->nisn }} · {{ $siswa->kelas?->nama_kelas ?? 'Kelas belum diatur' }} · {{ $siswa->jurusan?->nama_jurusan ?? 'Jurusan belum diatur' }}</small>@if($ditugaskanKeGuruLain)<span class="assignment-status">Sudah ditugaskan ke guru lain</span>@endif</span></label>@endforeach</div>
<div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;align-items:center;margin-top:17px"><span style="font-size:11px;color:#64748b">Siswa yang tidak dicentang akan dilepas dari guru ini.</span><button type="submit" style="padding:11px 16px;background:#17357f;color:#fff;border:0;border-radius:8px;font-size:12px;font-weight:650">Simpan Penugasan</button></div>
</form>
@endif
</div>
<div class="guru-profile-card"><h2 style="font-size:14px;margin:0 0 14px">Daftar Siswa Bimbingan Saat Ini</h2><div style="overflow-x:auto"><table style="width:100%;min-width:560px;border-collapse:collapse"><thead><tr><th style="text-align:left;padding:11px;background:#f8fafc">Nama Siswa</th><th style="text-align:left;padding:11px;background:#f8fafc">NISN</th><th style="text-align:left;padding:11px;background:#f8fafc">Kelas</th><th style="text-align:left;padding:11px;background:#f8fafc">Jurusan</th><th style="text-align:left;padding:11px;background:#f8fafc">Email</th></tr></thead><tbody>@forelse($guru->siswas as $siswa)<tr><td style="padding:11px;border-bottom:1px solid #edf0f5">{{ $siswa->nama_lengkap }}</td><td style="padding:11px;border-bottom:1px solid #edf0f5">{{ $siswa->nisn }}</td><td style="padding:11px;border-bottom:1px solid #edf0f5">{{ $siswa->kelas?->nama_kelas ?? '—' }}</td><td style="padding:11px;border-bottom:1px solid #edf0f5">{{ $siswa->jurusan?->nama_jurusan ?? '—' }}</td><td style="padding:11px;border-bottom:1px solid #edf0f5">{{ $siswa->user?->email ?? '—' }}</td></tr>@empty<tr><td colspan="5" style="padding:22px;text-align:center;color:#64748b">Belum ada siswa yang ditugaskan.</td></tr>@endforelse</tbody></table></div></div>
@endsection
@push('scripts')
<script>
const search = document.getElementById('studentSearch');
if (search) search.addEventListener('input', function () {
 const term = this.value.toLowerCase().trim();
 document.querySelectorAll('#studentOptions [data-search]').forEach(row => row.style.display = row.dataset.search.includes(term) ? 'flex' : 'none');
});
const select = document.getElementById('selectVisible');
if (select) select.addEventListener('click', function () {
 const rows = Array.from(document.querySelectorAll('#studentOptions [data-search]')).filter(row => row.style.display !== 'none');
 const check = rows.some(row => !row.querySelector('input').checked);
 rows.forEach(row => row.querySelector('input').checked = check);
});
</script>
@endpush