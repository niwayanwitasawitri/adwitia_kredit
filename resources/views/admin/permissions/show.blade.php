@extends('layouts.admin.app')

@section('title','Detail Permission')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Detail Permission
        </h2>

        <p class="text-muted mb-0">
            Informasi lengkap hak akses pada sistem
        </p>

    </div>

    {{-- CARD DETAIL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-key me-2"></i>
                Informasi Permission

            </h5>

        </div>

        <div class="card-body p-4">

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">

                    <i class="fas fa-hashtag me-2"></i>
                    ID Permission

                </div>

                <div class="col-md-9">

                    <span class="badge bg-secondary fs-6 px-3 py-2">
                        {{ $permission->id }}
                    </span>

                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">

                    <i class="fas fa-lock me-2"></i>
                    Nama Permission

                </div>

                <div class="col-md-9">

                    <span class="badge bg-success fs-6 px-3 py-2">
                        {{ $permission->name }}
                    </span>

                </div>

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-3 fw-bold text-success">

                    <i class="fas fa-info-circle me-2"></i>
                    Keterangan

                </div>

                <div class="col-md-9 text-muted">

                    Permission ini digunakan untuk mengatur hak akses pengguna terhadap fitur tertentu dalam sistem.

                </div>

            </div>

            {{-- TOMBOL --}}
            <div class="text-center mt-4">

                <a href="{{ route('admin.permissions.index') }}"
                   class="btn btn-outline-secondary rounded-pill px-4">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

                <a href="{{ route('admin.permissions.edit',$permission) }}"
                   class="btn btn-success rounded-pill px-4">

                    <i class="fas fa-edit me-2"></i>
                    Edit

                </a>

            </div>

        </div>

    </div>

</div>

@endsection