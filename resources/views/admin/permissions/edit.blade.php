@extends('layouts.admin.app')

@section('title','Edit Permission')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Edit Permission
        </h2>

        <p class="text-muted mb-0">
            Perbarui hak akses yang sudah terdaftar di sistem
        </p>

    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">
                <i class="fas fa-edit me-2"></i>
                Form Edit Permission
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

            <form action="{{ route('admin.permissions.update',$permission) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Nama Permission
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $permission->name) }}"
                        class="form-control form-control-lg"
                        placeholder="Contoh: update.user">

                    <small class="text-muted">
                        Gunakan format: aksi.modul
                        <br>
                        Contoh: create.user, update.produk, delete.pelanggan
                    </small>

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
                        href="{{ route('admin.permissions.index') }}"
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