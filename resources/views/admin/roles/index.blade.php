@extends('layouts.admin.app')

@section('title','Data Role')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h2 class="fw-bold text-success mb-1">
                        🌱 Data Role
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola hak akses pengguna dalam sistem
                    </p>

                </div>

                <a href="{{ route('admin.roles.create') }}"
                    class="btn btn-success rounded-pill px-4 mt-2 mt-md-0">

                    <i class="fas fa-user-shield me-2"></i>
                    Tambah Role

                </a>

            </div>

        </div>

    </div>

    {{-- TABEL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3">

            <h5 class="mb-0 text-center">

                <i class="fas fa-users-cog me-2"></i>
                Daftar Role

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="80">No</th>
                            <th>Nama Role</th>
                            <th width="180">Jumlah Permission</th>
                            <th width="180" class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($roles as $role)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <span class="fw-semibold">
                                    {{ $role->name }}
                                </span>

                            </td>

                            <td>

                                <span class="badge bg-success px-3 py-2">
                                    {{ $role->permissions->count() }} Permission
                                </span>

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.roles.show',$role) }}"
                                        class="btn btn-info btn-sm rounded-circle btn-action"
                                        title="Detail">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.roles.edit',$role) }}"
                                        class="btn btn-warning btn-sm rounded-circle btn-action"
                                        title="Edit">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.roles.destroy',$role) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus role ini?')"
                                            class="btn btn-danger btn-sm rounded-circle btn-action"
                                            title="Hapus">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center py-4">

                                <div class="text-muted">

                                    <i class="fas fa-folder-open fa-2x mb-2"></i>

                                    <p class="mb-0">
                                        Belum ada data role
                                    </p>

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