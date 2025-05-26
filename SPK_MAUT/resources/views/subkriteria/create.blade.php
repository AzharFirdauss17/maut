@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Tambah Subkriteria</h4>
    <form action="{{ route('subkriteria.store') }}" method="POST">
        @csrf
        @include('subkriteria.form')
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
