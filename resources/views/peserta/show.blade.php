@extends('layouts.app')

@section('content')
<h3>Detail Peserta</h3>
<hr>
<div class="card  col-md-6 p-4">
    <p><strong>Nama:</strong> {{$peserta->nama }}</p>
    <p><strong>Email:</strong> {{ $peserta->email }}</p>
    <p><strong>No HP:</strong> {{ $peserta->no_hp }}</p>
    <p><strong>Kode Skema:</strong> {{ $peserta->skema->kode_skema ?? '-' }}</p>
    <p><strong>Nama Skema:</strong> {{ $peserta->skema->nama_skema ?? '-' }}</p>
    <div>
        <a href="{{ route('peserta.index') }}" class="btn btn-info btn-secondary">Kembali</a>
    </div>
</div>
@endsection