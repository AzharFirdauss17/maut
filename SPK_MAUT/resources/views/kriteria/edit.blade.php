@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Edit Kriteria</h4>
    <form action="{{ route('kriteria.update', $kriteria->id_kriteria) }}" method="POST">
        @csrf
        @method('PUT')
        @include('kriteria.form', ['kriteria' => $kriteria])
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
