@extends('layouts.admin.app')

@section('title','Tambah Kategori')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Tambah Kategori Produk
        </h2>

        <p class="text-muted mb-0">
            Tambahkan kategori produk pertanian baru
        </p>

    </div>

    {{-- FORM --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">
                <i class="fas fa-tags me-2"></i>
                Form Tambah Kategori
            </h5>

        </div>

        <div class="card-body p-4">

            @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <form action="{{ route('admin.kategori-produk.store') }}" method="POST">

                @csrf

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Nama Kategori
                    </label>

                    <input type="text"
                           name="nama_kategori"
                           class="form-control form-control-lg"
                           placeholder="Masukkan nama kategori">

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi"
                              rows="4"
                              class="form-control"
                              placeholder="Masukkan deskripsi kategori"></textarea>

                </div>

                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <button type="submit"
                            class="btn btn-success rounded-pill px-4">

                        <i class="fas fa-save me-2"></i>
                        Simpan

                    </button>

                    <a href="{{ route('admin.kategori-produk.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-4">

                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection