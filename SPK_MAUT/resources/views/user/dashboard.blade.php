@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Dashboard</h2>
    <p>Hai, {{ Auth::user()->nama }}! Silakan ajukan pinjaman.</p>

    <a href="{{ route('loan.create') }}" class="btn btn-primary mb-3">Ajukan Pinjaman Baru</a>

    @if ($pinjaman)
        <div class="card mt-4">
            <div class="card-header">
                <strong>Detail Pengajuan Pinjaman</strong>
            </div>
            <div class="card-body">
                <ul>
                    <li><strong>Jumlah Dana:</strong> Rp{{ number_format($pinjaman->jumlah_dana, 0, ',', '.') }}</li>
                    <li><strong>Jangka Waktu:</strong> {{ $pinjaman->jangka_waktu }} bulan</li>
                    <li><strong>Status:</strong> {{ ucfirst($pinjaman->status) }}</li>
                    <li><strong>Nilai MAUT:</strong> {{ $pinjaman->nilai_maut }}</li>
                </ul>

                @if ($pinjaman->status === 'approved')
                    <a href="{{ route('pinjaman.pdf', $pinjaman->id_loan_request) }}" class="btn btn-success" target="_blank">Cetak PDF</a>
                @endif
            </div>
        </div>
    @else
        <p>Belum ada pengajuan pinjaman.</p>
    @endif
</div>
@endsection