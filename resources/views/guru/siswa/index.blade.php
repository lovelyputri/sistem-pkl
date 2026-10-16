@extends('layouts.guru')
@section('title','Siswa Bimbingan')
@section('page-heading','Siswa Bimbingan')
@section('content')
<h1>Siswa Bimbingan</h1>
<p class="guru-intro">Daftar siswa yang ditugaskan kepada akun guru ini.</p>
@include('guru.partials.stats')
<form class="guru-form" method="GET"><input type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari nama atau NISN"><button class="guru-btn">Cari siswa</button></form>
<div class="guru-panel"><div class="guru-table-wrap"><table><thead><tr><th>Nama</th><th>NISN</th><th>Sekolah</th><th>Kelas</th><th>Jurusan</th><th>Email</th></tr></thead><tbody>@forelse($siswas as $siswa)<tr><td>{{ $siswa->nama_lengkap }}</td><td>{{ $siswa->nisn }}</td><td>{{ $siswa->sekolah->nama_sekolah ?? '-' }}</td><td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td><td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td><td>{{ $siswa->user->email ?? '-' }}</td></tr>@empty<tr><td colspan="6" class="guru-muted">Belum ada siswa yang ditugaskan kepada Anda.</td></tr>@endforelse</tbody></table></div><div class="guru-pagination">{{ $siswas->links() }}</div></div>
@endsection
