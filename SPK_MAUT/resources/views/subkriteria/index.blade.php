@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Data Subkriteria</h3>
    <a href="{{ route('subkriteria.create') }}" class="btn btn-primary mb-3">Tambah Subkriteria</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Deskripsi</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subkriteria as $item)
                <tr>
                    <td>{{ $item->kriteria->keterangan }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ number_format($item->normalisasi, 3) }}</td>
                    <td>
                        <a href="{{ route('subkriteria.edit', $item->id_sub_kriteria) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('subkriteria.destroy', $item->id_sub_kriteria) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
