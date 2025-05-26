@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Penilaian</h3>
    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_alternatif" class="form-label">Pilih Alternatif</label>
            <select name="id_alternatif" id="id_alternatif" class="form-select" required>
                <option disabled selected>-- Pilih Pegawai --</option>
                @foreach($alternatifs as $alt)
                    <option value="{{ $alt->id_alternatif }}">{{ $alt->nama }}</option>
                @endforeach
            </select>
        </div>

        <hr>

        @foreach($kriterias as $kriteria)
            <div class="mb-3">
                <label class="form-label">{{ $kriteria->keterangan }} ({{ $kriteria->kode_kriteria }})</label>
                <select name="nilai[{{ $kriteria->id_kriteria }}]" class="form-select" required>
                    <option disabled selected>-- Pilih Nilai --</option>
                    @foreach($kriteria->subkriteria as $sub)
                        <option value="{{ $sub->nilai }}">{{ $sub->deskripsi }} ({{ $sub->nilai }})</option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Simpan Penilaian</button>
    </form>
</div>
@endsection
