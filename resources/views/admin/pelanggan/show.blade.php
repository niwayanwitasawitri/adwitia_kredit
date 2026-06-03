@extends('layouts.admin.app')

@section('title','Detail Pelanggan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Detail Pelanggan
        </h2>

        <p class="text-muted mb-0">
            Informasi lengkap data pelanggan
        </p>

    </div>

    {{-- CARD DETAIL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">
                <i class="fas fa-user-circle me-2"></i>
                Informasi Pelanggan
            </h5>

        </div>

        <div class="card-body p-4">

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-user me-2"></i>
                    Nama Pelanggan
                </div>

                <div class="col-md-9">
                    {{ $pelanggan->nama }}
                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-phone me-2"></i>
                    Nomor Telepon
                </div>

                <div class="col-md-9">
                    {{ $pelanggan->telepon }}
                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    Alamat
                </div>

                <div class="col-md-9">
                    {{ $pelanggan->alamat }}
                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-calendar-plus me-2"></i>
                    Tanggal Dibuat
                </div>

                <div class="col-md-9">
                    {{ $pelanggan->created_at->format('d M Y H:i') }}
                </div>

            </div>

            <div class="text-center mt-4">

                <a href="{{ route('admin.pelanggan.index') }}"
                   class="btn btn-outline-secondary rounded-pill px-4">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

                @if(auth()->user()->hasPermission('update.pelanggan'))



                @endif

            </div>

        </div>

    </div>

</div>

@endsection