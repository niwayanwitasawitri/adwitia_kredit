@extends('layouts.admin.app')

@section('title','Edit Produk')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Edit Produk
        </h2>

        <p class="text-muted mb-0">
            Perbarui informasi produk pertanian
        </p>

    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-edit me-2"></i>
                Form Edit Produk

            </h5>

        </div>

        <div class="card-body p-4">

            {{-- VALIDASI ERROR --}}
            @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <form action="{{ route('admin.produk.update',$produk) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- KATEGORI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Kategori Produk
                    </label>

                    <select name="kategori_produk_id" class="form-select form-select-lg">

                        @foreach($kategoris as $kategori)

                        <option value="{{ $kategori->id }}"
                            {{ $produk->kategori_produk_id == $kategori->id ? 'selected' : '' }}>

                            {{ $kategori->nama_kategori }}

                        </option>

                        @endforeach

                    </select>

                </div>

                {{-- NAMA PRODUK --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama_produk"
                        value="{{ old('nama_produk',$produk->nama_produk) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan nama produk">

                </div>

                {{-- HARGA --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Harga Produk
                    </label>

                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga',$produk->harga) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan harga produk">

                </div>

                {{-- STOK --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Stok Produk
                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok',$produk->stok) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan jumlah stok">

                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Deskripsi Produk
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan deskripsi produk">{{ old('deskripsi',$produk->deskripsi) }}</textarea>

                </div>

                {{-- TOMBOL --}}
                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <button
                        type="submit"
                        class="btn btn-success rounded-pill px-4">

                        <i class="fas fa-save me-2"></i>
                        Update

                    </button>

                    <a
                        href="{{ route('admin.produk.index') }}"
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