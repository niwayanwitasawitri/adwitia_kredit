@extends('layouts.admin.app')

@section('title','Detail Role')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Detail Role
        </h2>

        <p class="text-muted mb-0">
            Informasi role dan daftar permission yang dimiliki
        </p>

    </div>

    {{-- CARD DETAIL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-user-shield me-2"></i>
                Informasi Role

            </h5>

        </div>

        <div class="card-body p-4">

            {{-- NAMA ROLE --}}
            <div class="text-center mb-4">

                <div class="mb-3">

                    <i class="fas fa-user-shield fa-4x text-success"></i>

                </div>

                <h3 class="fw-bold text-success">

                    {{ $role->name }}

                </h3>

                <span class="badge bg-success px-3 py-2">

                    {{ $role->permissions->count() }} Permission

                </span>

            </div>

            <hr>

            {{-- DAFTAR PERMISSION --}}
            <h5 class="fw-bold text-success mb-3">

                <i class="fas fa-key me-2"></i>
                Daftar Permission

            </h5>

            @if($role->permissions->count())

                <div class="row">

                    @foreach($role->permissions as $permission)

                    <div class="col-lg-4 col-md-6 mb-3">

                        <div class="card border-success shadow-sm h-100">

                            <div class="card-body text-center">

                                <i class="fas fa-check-circle text-success mb-2"></i>

                                <div class="fw-semibold">

                                    {{ $permission->name }}

                                </div>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            @else

                <div class="alert alert-warning text-center">

                    <i class="fas fa-exclamation-circle me-2"></i>
                    Role ini belum memiliki permission.

                </div>

            @endif

            {{-- TOMBOL --}}
            <div class="text-center mt-4">

                <a href="{{ route('admin.roles.index') }}"
                    class="btn btn-outline-secondary rounded-pill px-4">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

                <a href="{{ route('admin.roles.edit',$role) }}"
                    class="btn btn-success rounded-pill px-4">

                    <i class="fas fa-edit me-2"></i>
                    Edit Role

                </a>

            </div>

        </div>

    </div>

</div>

@endsection