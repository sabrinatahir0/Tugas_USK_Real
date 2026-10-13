@extends('layouts.app')

@section('content')
<h3>Data Skema Sertifikasi</h3>
<hr>

{{-- Form Tambah Skema HANYA MUNCUL untuk Admin --}}
@if(auth()->user()->role == 'admin')
<div class="card p-3 mb-4">
    <h5>Tambah Skema</h5>
    <form method="POST" action="{{ route('skema.store') }}" class="row g-2">
        @csrf
        <div class="col-md-4">
            <input type="text" name="kode_skema" class="form-control" placeholder="Kode Skema" required>
        </div>
        <div class="col-md-6">
            <input type="text" name="nama_skema" class="form-control" placeholder="Nama Skema" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Simpan</button>
        </div>
    </form>
</div>
@endif

<table class="table table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Skema</th>
            @if(auth()->user()->role == 'admin')
                <th width="150">Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse($skema as $key => $s)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $s->kode_skema }}</td>
            <td>{{ $s->nama_skema }}</td>
            
            {{-- Kolom Aksi HANYA MUNCUL untuk Admin --}}
            @if(auth()->user()->role == 'admin')
            <td class="d-flex gap-1">
                {{-- Tombol Edit --}}
                <a href="{{ route('skema.edit', $s->id) }}" class="btn btn-warning btn-sm text-black">Edit</a>

                {{-- Form Hapus --}}
                <form action="{{ route('skema.destroy', $s->id) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm text-black" onclick="return confirm('Hapus skema?')">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
        @empty
        <tr>
            <td colspan="{{ auth()->user()->role == 'admin' ? 4 : 3 }}" class="text-center">Belum ada data skema.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection