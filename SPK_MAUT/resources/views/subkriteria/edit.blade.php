@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Edit Subkriteria</h4>
    <form action="{{ route('subkriteria.update', $subkriteria->id_sub_kriteria) }}" method="POST">
        @csrf
        @method('PUT')
        @include('subkriteria.form', ['subkriteria' => $subkriteria])
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
