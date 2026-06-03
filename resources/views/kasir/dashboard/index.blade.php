@extends('layouts.kasir.app')

@section('title','Dashboard Kasir')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <h2 class="fw-bold text-primary mb-1">
                💰 Dashboard Kasir
            </h2>

            <p class="text-muted mb-0">
                Ringkasan aktivitas penjualan dan transaksi hari ini
            </p>

        </div>

    </div>

    {{-- CARD STATISTIK --}}
    <div class="row">

        {{-- PRODUK --}}
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card border-0 shadow-lg rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Produk
                            </h6>

                            <h2 class="fw-bold text-primary">
                                {{ $data['totalProduk'] }}
                            </h2>

                        </div>

                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">

                            <i class="fas fa-box fa-2x text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- PELANGGAN --}}
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card border-0 shadow-lg rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Pelanggan
                            </h6>

                            <h2 class="fw-bold text-success">
                                {{ $data['totalPelanggan'] }}
                            </h2>

                        </div>

                        <div class="bg-success bg-opacity-10 rounded-circle p-3">

                            <i class="fas fa-users fa-2x text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- PENJUALAN --}}
        <div class="col-lg-4 col-md-12 mb-4">

            <div class="card border-0 shadow-lg rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Penjualan Hari Ini
                            </h6>

                            <h2 class="fw-bold text-warning">
                                {{ $data['penjualanHariIni'] }}
                            </h2>

                        </div>

                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">

                            <i class="fas fa-cash-register fa-2x text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- WELCOME CARD --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-primary text-white py-3 rounded-top-4">

            <h5 class="mb-0">

                <i class="fas fa-handshake me-2"></i>
                Selamat Datang

            </h5>

        </div>

        <div class="card-body p-4">

            <div class="row align-items-center">

                <div class="col-lg-2 text-center mb-3 mb-lg-0">

                    <i class="fas fa-user-circle text-primary"
                        style="font-size:90px;"></i>

                </div>

                <div class="col-lg-10">

                    <h4 class="fw-bold">

                        Halo,
                        <span class="text-primary">
                            {{ auth()->user()->name }}
                        </span>

                    </h4>

                    <p class="text-muted mb-2">

                        Anda login sebagai
                        <span class="badge bg-primary px-3 py-2">
                            Kasir
                        </span>

                    </p>

                    <p class="mb-0">

                        Kelola transaksi penjualan, pelanggan,
                        dan piutang dengan cepat dan akurat.

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection