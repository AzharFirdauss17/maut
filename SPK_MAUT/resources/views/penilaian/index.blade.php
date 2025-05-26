@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Data Penilaian</h3>
    <a href="{{ route('penilaian.create') }}" class="btn btn-primary mb-3">Tambah Penilaian</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Alternatif</th>
                <th>Kriteria</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penilaians as $penilaian)
                <tr>
                    <td>{{ $penilaian->alternatif->nama }}</td>
                    <td>{{ $penilaian->kriteria->keterangan }}</td>
                    <td>{{ number_format($penilaian->nilai, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
