@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Peserta Sertifikasi</h3>

    <form action="{{ route('peserta.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Peserta</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            <small class="text-muted">Hanya boleh berisi huruf dan spasi (tanpa angka/simbol).</small>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            <small class="text-muted">Email harus unik dan belum pernah terdaftar.</small>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" maxlength="20" required>
            <small class="text-muted">Maksimal 20 karakter.</small>
        </div>

        <div class="mb-3">
            <label>Pilih Skema</label>
            <select name="skema_id" class="form-select" required>
                <option value="">-- Pilih Skema --</option>
                @foreach($skema as $s)
                    <option value="{{ $s->id }}" {{ old('skema_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->nama_skema }} ({{ $s->kode_skema }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Peserta</button>
        <a href="{{ route('peserta.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection