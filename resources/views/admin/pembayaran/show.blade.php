@extends('layouts.admin.app')

@section('title','Detail Pembayaran')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Detail Pembayaran
        </h2>

        <p class="text-muted mb-0">
            Informasi lengkap transaksi pembayaran pelanggan
        </p>

    </div>

    {{-- CARD DETAIL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">
                <i class="fas fa-money-check-alt me-2"></i>
                Informasi Pembayaran
            </h5>

        </div>

        <div class="card-body p-4">

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-receipt me-2"></i>
                    Kode Penjualan
                </div>

                <div class="col-md-9">
                    {{ $pembayaran->penjualan->kode_penjualan }}
                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-user me-2"></i>
                    Pelanggan
                </div>

                <div class="col-md-9">
                    {{ $pembayaran->penjualan->pelanggan->nama }}
                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Tanggal Bayar
                </div>

                <div class="col-md-9">
                    {{ $pembayaran->tanggal_bayar->format('d-m-Y') }}
                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    Jumlah Bayar
                </div>

                <div class="col-md-9">
                    <span class="fw-bold text-success fs-5">
                        Rp {{ number_format($pembayaran->jumlah_bayar,0,',','.') }}
                    </span>
                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-sticky-note me-2"></i>
                    Keterangan
                </div>

                <div class="col-md-9">
                    {{ $pembayaran->keterangan ?? '-' }}
                </div>

            </div>

            {{-- TOMBOL --}}
            <div class="text-center mt-4">

                <a href="{{ route('admin.pembayaran.index') }}"
                   class="btn btn-outline-secondary rounded-pill px-4">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

@endsection