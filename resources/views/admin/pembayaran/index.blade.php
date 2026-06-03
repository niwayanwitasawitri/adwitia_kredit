@extends('layouts.admin.app')

@section('title','Data Pembayaran')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 rounded-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h2 class="fw-bold text-success mb-1">
                        🌱 Data Pembayaran
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola data pembayaran kredit pelanggan
                    </p>

                </div>

            </div>

        </div>

    </div>

    {{-- CARD TABEL --}}
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-success text-white py-3 rounded-top-4">

            <h5 class="mb-0 text-center">
                <i class="fas fa-money-bill-wave me-2"></i>
                Daftar Pembayaran
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-success">

                        <tr class="text-center">

                            <th width="70">No</th>
                            <th>Kode Penjualan</th>
                            <th>Pelanggan</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Bayar</th>
                            <th width="150">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pembayarans as $pembayaran)

                        <tr>

                            <td class="text-center fw-bold">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $pembayaran->penjualan->kode_penjualan }}
                                </span>
                            </td>

                            <td>
                                <i class="fas fa-user text-success me-1"></i>
                                {{ $pembayaran->penjualan->pelanggan->nama }}
                            </td>

                            <td>
                                <i class="fas fa-calendar-alt text-success me-1"></i>
                                {{ $pembayaran->tanggal_bayar->format('d-m-Y') }}
                            </td>

                            <td class="fw-bold text-success">
                                Rp {{ number_format($pembayaran->jumlah_bayar,0,',','.') }}
                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1 flex-wrap">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.pembayaran.show',$pembayaran) }}"
                                       class="btn btn-info btn-sm rounded-pill">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- HAPUS --}}
                                    @if(auth()->user()->hasPermission('delete.pembayaran'))

                                    <form action="{{ route('admin.pembayaran.destroy',$pembayaran) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm rounded-pill"
                                            onclick="return confirm('Yakin ingin menghapus data pembayaran ini?')">

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

                                    <i class="fas fa-file-invoice-dollar fa-3x mb-3"></i>

                                    <h6>
                                        Belum Ada Data Pembayaran
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