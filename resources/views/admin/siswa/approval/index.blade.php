@extends('layouts.admin')
@section('title', 'Persetujuan Siswa')
@section('page-heading', 'Persetujuan Siswa')
@section('content')
<h1>Persetujuan Pendaftaran Siswa</h1>
<p class="admin-intro">Pendaftar menunggu: {{ $totalPending }}</p>
@endsection
