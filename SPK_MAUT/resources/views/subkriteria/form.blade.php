@php $isEdit = isset($subkriteria); @endphp

<div class="mb-3">
    <label>Kriteria</label>
    <select name="id_kriteria" class="form-control" required>
        <option value="">-- Pilih Kriteria --</option>
        @foreach($kriteria as $item)
            <option value="{{ $item->id_kriteria }}"
                {{ $isEdit && $item->id_kriteria == $subkriteria->id_kriteria ? 'selected' : '' }}>
                {{ $item->keterangan }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Deskripsi</label>
    <input type="text" name="deskripsi" class="form-control" 
           value="{{ $isEdit ? $subkriteria->deskripsi : old('deskripsi') }}" required>
</div>
<div class="mb-3">
    <label>Nilai</label>
    <input type="number" step="0.01" name="nilai" class="form-control"
           value="{{ $isEdit ? $subkriteria->nilai : old('nilai') }}" required>
</div>
