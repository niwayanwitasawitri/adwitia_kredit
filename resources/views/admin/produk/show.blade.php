@extends('layouts.admin.app')

@section('title','Detail Produk')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Detail Produk
        </h2>

        <p class="text-muted mb-0">
            Informasi lengkap produk pertanian
        </p>

    </div>

    {{-- CARD DETAIL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-seedling me-2"></i>
                Informasi Produk

            </h5>

        </div>

        <div class="card-body p-4">

            {{-- KATEGORI --}}
            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-tags me-2"></i>
                    Kategori
                </div>

                <div class="col-md-9">

                    <span class="badge bg-success px-3 py-2">
                        {{ $produk->kategori->nama_kategori }}
                    </span>

                </div>

            </div>

            <hr>

            {{-- NAMA PRODUK --}}
            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-box me-2"></i>
                    Nama Produk
                </div>

                <div class="col-md-9">
                    {{ $produk->nama_produk }}
                </div>

            </div>

            <hr>

            {{-- HARGA --}}
            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    Harga
                </div>

                <div class="col-md-9">

                    <span class="fw-bold text-success fs-5">
                        Rp {{ number_format($produk->harga,0,',','.') }}
                    </span>

                </div>

            </div>

            <hr>

            {{-- STOK --}}
            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-warehouse me-2"></i>
                    Stok
                </div>

                <div class="col-md-9">

                    @if($produk->stok > 20)

                        <span class="badge bg-success px-3 py-2">
                            {{ $produk->stok }} Tersedia
                        </span>

                    @elseif($produk->stok > 5)

                        <span class="badge bg-warning text-dark px-3 py-2">
                            {{ $produk->stok }} Menipis
                        </span>

                    @else

                        <span class="badge bg-danger px-3 py-2">
                            {{ $produk->stok }} Hampir Habis
                        </span>

                    @endif

                </div>

            </div>

            <hr>

            {{-- DESKRIPSI --}}
            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">
                    <i class="fas fa-file-alt me-2"></i>
                    Deskripsi
                </div>

                <div class="col-md-9">

                    {{ $produk->deskripsi ?: 'Tidak ada deskripsi.' }}

                </div>

            </div>

            {{-- TOMBOL --}}
            <div class="text-center mt-4">

                <a href="{{ route('admin.produk.index') }}"
                   class="btn btn-outline-secondary rounded-pill px-4">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

                @if(auth()->user()->hasPermission('update.produk'))

                <a href="{{ route('admin.produk.edit',$produk) }}"
                   class="btn btn-success rounded-pill px-4">

                    <i class="fas fa-edit me-2"></i>
                    Edit Produk

                </a>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection