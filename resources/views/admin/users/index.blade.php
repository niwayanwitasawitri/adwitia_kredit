@extends('layouts.admin.app')

@section('title','Data User')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h2 class="fw-bold text-success mb-1">
                        🌱 Data User
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola data pengguna sistem ADWITIA KREDIT
                    </p>

                </div>

                @if(auth()->user()->hasPermission('create.user'))

                <a href="{{ route('admin.users.create') }}"
                    class="btn btn-success rounded-pill px-4 mt-2 mt-md-0">

                    <i class="fas fa-user-plus me-2"></i>
                    Tambah User

                </a>

                @endif

            </div>

        </div>

    </div>

    {{-- TABEL USER --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3">

            <h5 class="mb-0 text-center">

                <i class="fas fa-users me-2"></i>
                Daftar User

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="80">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="180" class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <div class="fw-semibold">

                                    <i class="fas fa-user-circle text-success me-2"></i>

                                    {{ $user->name }}

                                </div>

                            </td>

                            <td>

                                <span class="text-muted">

                                    {{ $user->email }}

                                </span>

                            </td>

                            <td>

                                <span class="badge bg-success px-3 py-2">

                                    {{ $user->role->name }}

                                </span>

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.users.show',$user) }}"
                                        class="btn btn-info btn-sm btn-action rounded-circle"
                                        title="Detail">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.users.edit',$user) }}"
                                        class="btn btn-warning btn-sm btn-action rounded-circle"
                                        title="Edit">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.users.destroy',$user) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus user ini?')"
                                            class="btn btn-danger btn-sm btn-action rounded-circle"
                                            title="Hapus">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="fas fa-users-slash fa-3x mb-3"></i>

                                    <h6>
                                        Belum Ada Data User
                                    </h6>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection