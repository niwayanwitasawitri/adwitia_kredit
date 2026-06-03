@extends('layouts.admin.app')

@section('title','Edit Kategori')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success">
            <i class="fas fa-edit me-2"></i>
            Edit Kategori Produk
        </h2>

        <p class="text-muted">
            Ubah informasi kategori produk yang sudah tersimpan
        </p>

    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow rounded-4">

        <div class="card-header bg-success text-white py-3">

            <h5 class="mb-0 text-center">
                🌱 Form Edit Kategori
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

            <form action="{{ route('admin.kategori-produk.update',$kategori) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="nama_kategori"
                        value="{{ old('nama_kategori',$kategori->nama_kategori) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan nama kategori">

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan deskripsi kategori">{{ old('deskripsi',$kategori->deskripsi) }}</textarea>

                </div>

                {{-- TOMBOL --}}
                <div class="d-flex justify-content-center gap-2">

                    <button type="submit"
                            class="btn btn-success px-4 rounded-pill">

                        <i class="fas fa-save me-2"></i>
                        Update

                    </button>

                    <a href="{{ route('admin.kategori-produk.index') }}"
                       class="btn btn-outline-secondary px-4 rounded-pill">

                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection