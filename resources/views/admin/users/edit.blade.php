@extends('layouts.admin.app')

@section('title','Edit User')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Edit User
        </h2>

        <p class="text-muted mb-0">
            Perbarui informasi pengguna sistem
        </p>

    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-user-edit me-2"></i>
                Form Edit User

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

            <form action="{{ route('admin.users.update',$user) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        <i class="fas fa-user text-success me-2"></i>
                        Nama Lengkap

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan nama lengkap">

                </div>

                {{-- EMAIL --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        <i class="fas fa-envelope text-success me-2"></i>
                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="form-control form-control-lg"
                        placeholder="Masukkan email">

                </div>

                {{-- ROLE --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        <i class="fas fa-user-shield text-success me-2"></i>
                        Role

                    </label>

                    <select
                        name="role_id"
                        class="form-select form-select-lg">

                        @foreach($roles as $role)

                        <option
                            value="{{ $role->id }}"
                            {{ $user->role_id == $role->id ? 'selected' : '' }}>

                            {{ $role->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                {{-- BUTTON --}}
                <div class="text-center mt-4">

                    <button
                        type="submit"
                        class="btn btn-success rounded-pill px-4">

                        <i class="fas fa-save me-2"></i>
                        Update User

                    </button>

                    <a
                        href="{{ route('admin.users.index') }}"
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