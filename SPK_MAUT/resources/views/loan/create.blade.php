@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formulir Pengajuan Pinjaman</h2>
    <form action="{{ route('loan.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="jumlah_dana">Jumlah Dana yang Dipinjam</label>
            <input type="number" name="jumlah_dana" class="form-control" required placeholder="Contoh: 500000">
        </div>

        <div class="form-group mb-3">
            <label for="jangka_waktu">Jangka Waktu Pengembalian (bulan)</label>
            <select name="jangka_waktu" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="12">12 Bulan</option>
            </select>
        </div>

        @foreach($kriterias as $kriteria)
            <div class="form-group mb-3">
                <label for="kriteria_{{ $kriteria->id_kriteria }}">{{ $kriteria->keterangan }}</label>
                <select name="pilihan[]" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach($kriteria->subKriteria as $sub)
                        <option value="{{ $sub->id_sub_kriteria }}">
                            {{ $sub->deskripsi }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Ajukan Pinjaman</button>
    </form>
</div>
@endsection