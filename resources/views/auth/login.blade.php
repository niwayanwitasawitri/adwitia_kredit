@extends('layouts.auth.app')

@section('title','Login')

@section('content')

<h4 class="text-center mb-4 fw-bold">
    Login Sistem
</h4>

@if(session('success'))

<div class="alert alert-success rounded-3">
    {{ session('success') }}
</div>

@endif

@if($errors->any())

<div class="alert alert-danger rounded-3">


<ul class="mb-0">
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>


</div>

@endif

<form action="{{ route('login.authenticate') }}"
      method="POST">


@csrf

<div class="mb-3">

    <label class="form-label fw-semibold">
        Email
    </label>

    <input type="email"
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

    <input type="password"
           name="password"
           class="form-control"
           placeholder="Masukkan Password"
           required>

</div>

<div class="d-grid">

    <button type="submit"
            class="btn btn-login text-white">

        <i class="fas fa-sign-in-alt me-2"></i>
        Login

    </button>

</div>


</form>

<hr>

<div class="auth-footer">


<small>

    Belum punya akun?

    <a href="{{ route('register') }}"
       class="fw-bold text-success text-decoration-none">

        Register

    </a>

</small>


</div>

@endsection