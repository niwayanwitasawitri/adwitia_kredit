@extends('layouts.admin.app')

@section('title','Edit Pelanggan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Edit Pelanggan
        </h2>

        <p class="text-muted mb-0">
            Perbarui data pelanggan yang sudah terdaftar
        </p>

    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">
                <i class="fas fa-user-edit me-2"></i>
                Form Edit Pelanggan
            </h5>

        </div>

        <div class="card-body p-4">

            {{-- VALIDASI ERROR --}}
            @if ($errors->any())

                <div class="alert alert-danger rounded-3">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('admin.pelanggan.update', $pelanggan) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama', $pelanggan->nama) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan nama pelanggan">

                </div>

                {{-- TELEPON --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="telepon"
                        value="{{ old('telepon', $pelanggan->telepon) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan nomor telepon">

                </div>

                {{-- ALAMAT --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan alamat pelanggan">{{ old('alamat', $pelanggan->alamat) }}</textarea>

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
                        href="{{ route('admin.pelanggan.index') }}"
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