@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>!</p>
    <hr>

    {{-- Cards Total Data --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card bg-primary text-white p-3">
                <h5>Total Peserta</h5>
                <h3 class="m-0">{{ $total_peserta }} Orang</h3>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card bg-success text-white p-3">
                <h5>Total Skema</h5>
                <h3 class="m-0">{{ $total_skema }} Skema</h3>
            </div>
        </div>
    </div>

    {{-- Tabel Data Peserta Terbaru --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peserta Sertifikasi</h5>
            <a href="{{ route('peserta.index') }}" class="btn btn-sm btn-info">Lihat Semua Data</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Skema</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peserta_terbaru as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td><span class="badge bg-light text-dark fw-normal">{{ $p->skema->nama_skema ?? '-' }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">Belum ada data peserta.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 