@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ubah Data Peserta</h3>

    <!-- Menampilkan pesan error validasi dari controller -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Peserta</label>
            <!-- pattern="[A-Za-z\s]+" mencegah input angka/simbol secara langsung di browser -->
            <input type="text" name="nama" class="form-control" value="{{ $peserta->nama }}" pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <!-- Pengecekan email agar tidak sama/sudah terdaftar di-handle oleh Controller -->
            <input type="email" name="email" class="form-control" value="{{ $peserta->email }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <!-- maxlength="20" membatasi input agar tidak lebih dari 20 karakter -->
            <input type="text" name="no_hp" class="form-control" value="{{ $peserta->no_hp }}" maxlength="20" required>
        </div>

        <div class="mb-3">
            <label>Pilih Skema</label>
            <select name="skema_id" class="form-select" required>
                @foreach($skema as $s)
                    <option value="{{ $s->id }}" {{ $peserta->skema_id == $s->id ? 'selected' : '' }}>
                        {{ $s->nama_skema }} ({{ $s->kode_skema }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('peserta.index') }}" class="btn btn-light btn-outline-danger">Batal</a>
    </form>
</div>
@endsection