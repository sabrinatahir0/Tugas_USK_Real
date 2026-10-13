@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Ubah Data Skema</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('skema.update', $skema->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kode Skema</label>
                    <input type="text" name="kode_skema" class="form-control" value="{{ old('kode_skema', $skema->kode_skema) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Skema</label>
                    <input type="text" name="nama_skema" class="form-control" value="{{ old('nama_skema', $skema->nama_skema) }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{ route('skema.index') }}" class="btn btn-light btn-outline-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection