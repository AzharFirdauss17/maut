@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, {{ Auth::user()->nama }}!</p>
    <ul>
        <li><a href="{{ route('kriteria.index') }}">Kelola Kriteria</a></li>
        <li><a href="{{ route('subkriteria.index') }}">Kelola Sub-Kriteria</a></li>
        <li><a href="{{ route('admin.pinjaman.index') }}">Lihat Pengajuan Pinjaman</a></li>
    </ul>
</div>
@endsection