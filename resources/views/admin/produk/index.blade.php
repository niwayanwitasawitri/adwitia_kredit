@extends('layouts.admin.app')

@section('title','Data Produk')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 rounded-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="fw-bold text-success mb-1">
                        🌱 Data Produk
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola seluruh produk pertanian yang tersedia dalam sistem
                    </p>

                </div>

                @if(auth()->user()->hasPermission('create.produk'))

                <a href="{{ route('admin.produk.create') }}"
                   class="btn btn-success rounded-pill px-4">

                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Produk

                </a>

                @endif

            </div>

        </div>

    </div>

    {{-- TABEL PRODUK --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">

                <i class="fas fa-seedling me-2"></i>
                Daftar Produk Pertanian

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-success">

                        <tr class="text-center">

                            <th width="70">No</th>
                            <th>Kategori</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th width="180">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($produks as $produk)

                        <tr>

                            <td class="text-center fw-bold">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="badge bg-success px-3 py-2">
                                    {{ $produk->kategori->nama_kategori }}
                                </span>
                            </td>

                            <td class="fw-semibold">
                                {{ $produk->nama_produk }}
                            </td>

                            <td class="fw-bold text-success">
                                Rp {{ number_format($produk->harga,0,',','.') }}
                            </td>

                            <td>

                                @if($produk->stok > 20)

                                    <span class="badge bg-success">
                                        {{ $produk->stok }}
                                    </span>

                                @elseif($produk->stok > 5)

                                    <span class="badge bg-warning text-dark">
                                        {{ $produk->stok }}
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        {{ $produk->stok }}
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1 flex-wrap">

                                    {{-- DETAIL --}}
                                    @if(auth()->user()->hasPermission('read.produk'))

                                    <a href="{{ route('admin.produk.show',$produk) }}"
                                       class="btn btn-info btn-sm rounded-pill"
                                       title="Detail">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    @endif

                                    {{-- EDIT --}}
                                    @if(auth()->user()->hasPermission('update.produk'))

                                    <a href="{{ route('admin.produk.edit',$produk) }}"
                                       class="btn btn-warning btn-sm rounded-pill text-white"
                                       title="Edit">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    @endif

                                    {{-- HAPUS --}}
                                    @if(auth()->user()->hasPermission('delete.produk'))

                                    <form action="{{ route('admin.produk.destroy',$produk) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                            class="btn btn-danger btn-sm rounded-pill"
                                            title="Hapus">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <div class="text-muted">

                                    <i class="fas fa-box-open fa-3x mb-3"></i>

                                    <h6>
                                        Belum Ada Data Produk
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