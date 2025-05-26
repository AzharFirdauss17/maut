@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Pinjaman</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Jumlah Dana</th>
                <th>Jangka Waktu</th>
                <th>Nilai MAUT</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuan as $p)
            <tr>
                <td>{{ $p->user->nama }}</td>
                <td>Rp {{ number_format($p->jumlah_dana, 0, ',', '.') }}</td>
                <td>{{ $p->jangka_waktu }} bulan</td>
                <td>{{ $p->nilai_maut }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>
                    @if ($p->status == 'pending')
                        @if ($p->nilai_maut >= 60)
                            <form action="{{ route('admin.pinjaman.acc', $p->id_loan_request) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">ACC</button>
                            </form>
                            <form action="{{ route('admin.pinjaman.tolak', $p->id_loan_request) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-1">Tolak</button>
                            </form>
                        @else
                            <span class="text-muted">Tidak Memenuhi Syarat</span>
                        @endif
                    @else
                        {{ ucfirst($p->status) }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection