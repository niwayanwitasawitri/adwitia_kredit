@extends('layouts.admin.app')

@section('title','Tambah Role')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Tambah Role
        </h2>

        <p class="text-muted mb-0">
            Tambahkan role baru beserta hak akses pengguna
        </p>

    </div>

    <form action="{{ route('admin.roles.store') }}" method="POST">

        @csrf

        {{-- INFORMASI ROLE --}}
        <div class="card border-0 shadow-lg rounded-4 mb-4">

            <div class="card-header bg-success text-white py-3">

                <h5 class="mb-0 text-center">

                    <i class="fas fa-user-shield me-2"></i>
                    Informasi Role

                </h5>

            </div>

            <div class="card-body p-4">

                <label class="form-label fw-semibold">
                    Nama Role
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control form-control-lg"
                    placeholder="Masukkan nama role">

            </div>

        </div>

        {{-- PERMISSION --}}
        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header bg-success text-white py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <h5 class="mb-0">

                        <i class="fas fa-key me-2"></i>
                        Pengaturan Permission

                    </h5>

                    <button
                        type="button"
                        id="checkAll"
                        class="btn btn-light btn-sm">

                        <i class="fas fa-check-double me-1"></i>
                        Centang Semua

                    </button>

                </div>

            </div>

            <div class="card-body p-4">

                <div class="row">

                    @foreach($permissions as $group => $items)

                    <div class="col-lg-6 mb-4">

                        <div class="card border-success shadow-sm h-100">

                            <div class="card-header bg-light">

                                <div class="d-flex justify-content-between align-items-center flex-wrap">

                                    <strong class="text-success">

                                        <i class="fas fa-folder-open me-2"></i>

                                        {{ strtoupper(str_replace('-', ' ', $group)) }}

                                    </strong>

                                    <div>

                                        <button
                                            type="button"
                                            class="btn btn-success btn-sm select-all"
                                            data-group="{{ $group }}">

                                            Semua

                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-outline-danger btn-sm unselect-all"
                                            data-group="{{ $group }}">

                                            Batal

                                        </button>

                                    </div>

                                </div>

                            </div>

                            <div class="card-body">

                                @foreach($items as $permission)

                                <div class="form-check mb-2">

                                    <input
                                        type="checkbox"
                                        class="form-check-input permission permission-{{ $group }}"
                                        id="permission{{ $permission->id }}"
                                        name="permissions[]"
                                        value="{{ $permission->id }}">

                                    <label
                                        class="form-check-label"
                                        for="permission{{ $permission->id }}">

                                        {{ $permission->name }}

                                    </label>

                                </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                {{-- BUTTON --}}
                <div class="text-center mt-4">

                    <button
                        type="submit"
                        class="btn btn-success rounded-pill px-4">

                        <i class="fas fa-save me-2"></i>
                        Simpan Role

                    </button>

                    <a
                        href="{{ route('admin.roles.index') }}"
                        class="btn btn-outline-secondary rounded-pill px-4">

                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </form>

</div>

<script>

document.addEventListener('DOMContentLoaded', function() {

    // Centang semua permission
    document.getElementById('checkAll')
        .addEventListener('click', function() {

            document.querySelectorAll('.permission')
                .forEach(item => item.checked = true);

        });

    // Centang per grup
    document.querySelectorAll('.select-all')
        .forEach(button => {

            button.addEventListener('click', function() {

                let group = this.dataset.group;

                document.querySelectorAll('.permission-' + group)
                    .forEach(item => item.checked = true);

            });

        });

    // Batal per grup
    document.querySelectorAll('.unselect-all')
        .forEach(button => {

            button.addEventListener('click', function() {

                let group = this.dataset.group;

                document.querySelectorAll('.permission-' + group)
                    .forEach(item => item.checked = false);

            });

        });

});

</script>

@endsection