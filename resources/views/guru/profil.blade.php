@extends('layouts.guru')
@section('title','Profil Guru')
@section('page-heading','Profil Saya')
@section('content')
<h1>Profil Guru</h1><p class="guru-intro">Informasi akun dan data guru pembimbing.</p>
<div class="guru-panel"><table><tbody><tr><th>Nama lengkap</th><td>{{ $guru->nama_lengkap }}</td></tr><tr><th>Email akun</th><td>{{ $guru->user->email ?? '-' }}</td></tr><tr><th>NIP</th><td>{{ $guru->nip ?: '-' }}</td></tr><tr><th>Nomor telepon</th><td>{{ $guru->no_telepon ?: '-' }}</td></tr><tr><th>Sekolah</th><td>{{ $guru->sekolah->nama_sekolah ?? '-' }}</td></tr></tbody></table><p class="guru-muted" style="margin-top:14px">Untuk perubahan data, silakan hubungi administrator sekolah.</p></div>
@endsection