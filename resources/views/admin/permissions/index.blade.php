@extends('layouts.admin.app')

@section('title','Data Permission')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 rounded-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="fw-bold text-success mb-1">
                        🌱 Data Permission
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola hak akses dan izin pengguna sistem
                    </p>

                </div>

                <a href="{{ route('admin.permissions.create') }}"
                   class="btn btn-success rounded-pill px-4">

                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Permission

                </a>

            </div>

        </div>

    </div>

    {{-- TABEL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-key me-2"></i>
                Daftar Permission

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-success">

                        <tr class="text-center">

                            <th width="80">No</th>
                            <th>Permission</th>
                            <th width="180">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($permissions as $permission)

                        <tr>

                            <td class="text-center fw-bold">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="badge bg-success fs-6 px-3 py-2">
                                    {{ $permission->name }}
                                </span>
                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1 flex-wrap">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.permissions.show',$permission) }}"
                                       class="btn btn-info btn-sm rounded-pill"
                                       title="Detail">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.permissions.edit',$permission) }}"
                                       class="btn btn-warning btn-sm rounded-pill text-white"
                                       title="Edit">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.permissions.destroy',$permission) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm rounded-pill"
                                            onclick="return confirm('Yakin ingin menghapus permission ini?')"
                                            title="Hapus">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="fas fa-key fa-3x mb-3"></i>

                                    <h6>
                                        Belum Ada Data Permission
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