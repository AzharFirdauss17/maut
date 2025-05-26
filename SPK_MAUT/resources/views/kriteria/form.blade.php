@php
    $isEdit = isset($kriteria);
@endphp

<div class="mb-3">
    <label>Kode Kriteria</label>
    <input type="text" class="form-control" name="kode_kriteria" 
        value="{{ $isEdit ? $kriteria->kode_kriteria : old('kode_kriteria') }}" required>
</div>
<div class="mb-3">
    <label>Keterangan</label>
    <input type="text" class="form-control" name="keterangan" 
        value="{{ $isEdit ? $kriteria->keterangan : old('keterangan') }}" required>
</div>
<div class="mb-3">
    <label>Bobot</label>
    <input type="number" step="0.01" class="form-control" name="bobot" disabled
        value="{{ $isEdit ? $kriteria->bobot : old('bobot') }}" >
</div>
