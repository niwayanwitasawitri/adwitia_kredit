@extends('layouts.admin.app')

@section('title','Data Pelanggan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 rounded-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="fw-bold text-success mb-1">
                        🌱 Data Pelanggan
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola seluruh data pelanggan toko pertanian
                    </p>

                </div>

                @if(auth()->user()->hasPermission('create.pelanggan'))

                <a href="{{ route('admin.pelanggan.create') }}"
                   class="btn btn-success rounded-pill px-4">

                    <i class="fas fa-user-plus me-2"></i>
                    Tambah Pelanggan

                </a>

                @endif

            </div>

        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-users me-2"></i>
                Daftar Pelanggan

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-success">

                        <tr class="text-center">

                            <th width="70">No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th width="180">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pelanggans as $pelanggan)

                        <tr>

                            <td class="text-center fw-bold">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $pelanggan->nama }}
                            </td>

                            <td>
                                {{ $pelanggan->telepon }}
                            </td>

                            <td>
                                {{ $pelanggan->alamat }}
                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1 flex-wrap">

                                    {{-- DETAIL --}}
                                    @if(auth()->user()->hasPermission('read.pelanggan'))

                                    <a href="{{ route('admin.pelanggan.show',$pelanggan) }}"
                                       class="btn btn-info btn-sm rounded-pill">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    @endif

                                    {{-- EDIT --}}
                                    @if(auth()->user()->hasPermission('update.pelanggan'))

                                    <a href="{{ route('admin.pelanggan.edit',$pelanggan) }}"
                                       class="btn btn-warning btn-sm rounded-pill text-white">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    @endif

                                    {{-- HAPUS --}}
                                    @if(auth()->user()->hasPermission('delete.pelanggan'))

                                    <form action="{{ route('admin.pelanggan.destroy',$pelanggan) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus pelanggan ini?')"
                                            class="btn btn-danger btn-sm rounded-pill">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-4">

                                <div class="text-muted">

                                    <i class="fas fa-folder-open fa-2x mb-2"></i>

                                    <p class="mb-0">
                                        Belum ada data pelanggan
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