@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Peserta Sertifikasi</h3>
    
    {{-- Tombol Tambah Peserta HANYA MUNCUL untuk Admin --}}
    @if(auth()->user()->role == 'admin')
        <a href="{{ route('peserta.create') }}" class="btn btn-primary">+ Tambah Peserta</a>
    @endif
</div>

<form method="GET" class="mb-3 d-flex gap-2">
    <input type="text" name="cari" class="form-control" placeholder="Cari nama/skema..." value="{{ $cari ?? '' }}">
    <button type="submit" class="btn btn-warning text-black">Cari</button>
</form>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Skema</th>
            
            {{-- Kolom Aksi HANYA MUNCUL untuk Admin --}}
            @if(auth()->user()->role == 'admin')
                <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse($peserta as $key => $p)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->no_hp }}</td>
            <td><span class="badge bg-light text-dark fw-normal">{{ $p->skema->nama_skema ?? '-' }}</span></td>
            
            {{-- Tombol Aksi (Detail, Edit, Hapus) HANYA MUNCUL untuk Admin --}}
            @if(auth()->user()->role == 'admin')
                <td class="d-flex gap-1">
                    <a href="{{ route('peserta.show', $p->id) }}" class="btn btn-secondary btn-sm text-black">Detail</a>
                    <a href="{{ route('peserta.edit', $p->id) }}" class="btn btn-success btn-sm text-black">Edit</a>
                    <form action="{{ route('peserta.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm text-black" onclick="return confirm('Hapus peserta?')">Hapus</button>
                    </form>
                </td>
            @endif
        </tr>
        @empty
        <tr>
            {{-- Colspan dinamis: 6 jika admin, 5 jika user biasa --}}
            <td colspan="{{ auth()->user()->role == 'admin' ? 6 : 5 }}" class="text-center">Belum ada data peserta.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection