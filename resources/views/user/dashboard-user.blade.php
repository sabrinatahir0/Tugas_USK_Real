@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Peserta</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
    <hr>

    <div class="card shadow-sm p-4">
        <h4 class="mb-3">Informasi Data Diri Anda</h4>

        @if(isset($peserta) && $peserta)
            <div class="table-responsive mb-3">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 25%;">Nama Lengkap</th>
                        <td>{{ $peserta->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $peserta->email }}</td>
                    </tr>
                    <tr>
                        <th>Nomor HP</th>
                        <td>{{ $peserta->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Skema Sertifikasi</th>
                        <td>
                            <span class=" text-dark">
                                {{ $peserta->skema->nama_skema ?? '-' }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Tombol Edit Data Diri Sendiri -->
            <div>
                <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-primary">Edit Data Diri Saya</a>
            </div>
        @else
            <div class="alert alert-warning">
                Data peserta dengan email <strong>{{ Auth::user()->email }}</strong> belum terdaftar di sistem. Silakan hubungi Admin untuk mendaftarkan email Anda.
            </div>
        @endif
    </div>
</div>
@endsection