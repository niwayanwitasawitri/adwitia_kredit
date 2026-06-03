@extends('layouts.admin.app')

@section('title','Detail Kategori')

@section('content')

<div class="container-fluid">

    <div class="text-center mb-4">

        <h2 class="fw-bold text-success">
            🌱 Detail Kategori Produk
        </h2>

        <p class="text-muted">
            Informasi kategori produk pertanian
        </p>

    </div>

    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white text-center py-3">

            <h5 class="mb-0">
                <i class="fas fa-eye me-2"></i>
                Detail Kategori
            </h5>

        </div>

        <div class="card-body p-4">

            <div class="row">

                <div class="col-md-3 fw-bold text-success">
                    Nama Kategori
                </div>

                <div class="col-md-9">
                    : {{ $kategori->nama_kategori }}
                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-3 fw-bold text-success">
                    Deskripsi
                </div>

                <div class="col-md-9">
                    : {{ $kategori->deskripsi }}
                </div>

            </div>

            <div class="text-center mt-4">

                <a href="{{ route('admin.kategori-produk.index') }}"
                   class="btn btn-outline-secondary rounded-pill px-4">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

@endsection