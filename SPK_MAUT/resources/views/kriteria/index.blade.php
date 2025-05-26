@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Data Kriteria</h3>
    <a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-3">Tambah Kriteria</a>
    <a href="{{ route('maut.hitung') }}" class="btn btn-success mb-3">
        Hitung Bobot (MAUT)
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Keterangan</th>
                <th>Bobot</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriteria as $item)
                <tr>
                    <td>{{ $item->kode_kriteria }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ number_format($item->bobot, 3) }}</td>

                    <td>
                        <a href="{{ route('kriteria.edit', $item->id_kriteria) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kriteria.destroy', $item->id_kriteria) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus kriteria ini?');">
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
