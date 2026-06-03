@extends('layouts.auth.app')

@section('title','Register')

@section('content')

<h4 class="text-center mb-4 fw-bold">
    Registrasi Kasir
</h4>

@if($errors->any())

<div class="alert alert-danger rounded-3">


<ul class="mb-0">

    @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

    @endforeach

</ul>


</div>

@endif

<form action="{{ route('register.store') }}"
      method="POST">


@csrf

<div class="mb-3">

    <label class="form-label fw-semibold">
        Nama
    </label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name') }}"
        placeholder="Masukkan Nama"
        required>

</div>

<div class="mb-3">

    <label class="form-label fw-semibold">
        Email
    </label>

    <input
        type="email"
        name="email"
        class="form-control"
        value="{{ old('email') }}"
        placeholder="Masukkan Email"
        required>

</div>

<div class="mb-3">

    <label class="form-label fw-semibold">
        Password
    </label>

    <input
        type="password"
        name="password"
        class="form-control"
        placeholder="Masukkan Password"
        required>

</div>

<div class="mb-3">

    <label class="form-label fw-semibold">
        Konfirmasi Password
    </label>

    <input
        type="password"
        name="password_confirmation"
        class="form-control"
        placeholder="Ulangi Password"
        required>

</div>

<div class="d-grid">

    <button
        type="submit"
        class="btn btn-register text-white">

        <i class="fas fa-user-plus me-2"></i>
        Register

    </button>

</div>


</form>

<hr>

<div class="auth-footer">


<small>

    Sudah punya akun?

    <a href="{{ route('login') }}"
       class="fw-bold text-success text-decoration-none">

        Login

    </a>

</small>


</div>

@endsection