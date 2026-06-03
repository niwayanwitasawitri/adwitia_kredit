@extends('layouts.admin.app')

@section('title','Detail User')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="text-center mb-4">

        <h2 class="fw-bold text-success mb-2">
            🌱 Detail User
        </h2>

        <p class="text-muted mb-0">
            Informasi lengkap pengguna sistem
        </p>

    </div>

    {{-- CARD DETAIL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-user-circle me-2"></i>
                Informasi User

            </h5>

        </div>

        <div class="card-body p-4">

            {{-- FOTO / ICON USER --}}
            <div class="text-center mb-4">

                <div class="mb-3">

                    <i class="fas fa-user-circle text-success"
                       style="font-size: 80px;"></i>

                </div>

                <h3 class="fw-bold text-success">

                    {{ $user->name }}

                </h3>

                <span class="badge bg-success px-3 py-2">

                    {{ $user->role->name }}

                </span>

            </div>

            <hr>

            {{-- DETAIL USER --}}
            <div class="table-responsive">

                <table class="table table-borderless">

                    <tbody>

                        <tr>

                            <th width="200" class="text-success">

                                <i class="fas fa-user me-2"></i>
                                Nama

                            </th>

                            <td>

                                {{ $user->name }}

                            </td>

                        </tr>

                        <tr>

                            <th class="text-success">

                                <i class="fas fa-envelope me-2"></i>
                                Email

                            </th>

                            <td>

                                {{ $user->email }}

                            </td>

                        </tr>

                        <tr>

                            <th class="text-success">

                                <i class="fas fa-user-shield me-2"></i>
                                Role

                            </th>

                            <td>

                                <span class="badge bg-success px-3 py-2">

                                    {{ $user->role->name }}

                                </span>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            {{-- BUTTON --}}
            <div class="text-center mt-4">

                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-outline-secondary rounded-pill px-4">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

                <a href="{{ route('admin.users.edit',$user) }}"
                   class="btn btn-success rounded-pill px-4">

                    <i class="fas fa-edit me-2"></i>
                    Edit User

                </a>

            </div>

        </div>

    </div>

</div>

@endsection