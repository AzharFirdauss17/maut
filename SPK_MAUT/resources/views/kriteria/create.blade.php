@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Tambah Kriteria</h4>
    <form action="{{ route('kriteria.store') }}" method="POST">
        @csrf
        @include('kriteria.form')
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
