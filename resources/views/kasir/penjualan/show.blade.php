@extends('layouts.kasir.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <div class="mb-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Detail Transaksi Penjualan</h3>
            <p class="text-muted small mb-0">Informasi lengkap mengenai item barang, nominal belanja, dan status piutang pelanggan.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <div>
                            <small class="text-muted text-uppercase d-block fs-7 fw-bold">Kode Nota</small>
                            <span class="font-monospace fw-bold text-dark fs-5">#{{ $penjualan->kode_penjualan }}</span>
                        </div>
                        <div>
                            @if(strtoupper($penjualan->status) == 'LUNAS' || (isset($penjualan->piutang) && $penjualan->piutang->sisa_piutang == 0))
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-3 border border-success-subtle fw-semibold fs-7">
                                    ✓ LUNAS
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-3 border border-danger-subtle fw-semibold fs-7">
                                    ✗ BELUM LUNAS
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-uppercase fs-7 text-muted fw-semibold d-block mb-1">Nama Pelanggan</label>
                        <div class="fw-bold text-dark fs-6">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-uppercase fs-7 text-muted fw-semibold d-block mb-1">Total Belanja</label>
                        <div class="fw-extrabold text-primary fs-3 font-monospace">
                            Rp {{ number_format($penjualan->total) }}
                        </div>
                    </div>
                </div>
            </div>

            @if($penjualan->piutang)
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-light border-0 py-3 px-4">
                    <h5 class="fw-bold text-dark mb-0 fs-6">Informasi Tagihan Kredit</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3 border-bottom pb-2">
                        <label class="form-label text-uppercase fs-7 text-muted fw-semibold d-block mb-1">Sisa Piutang</label>
                        <div class="fw-bold text-danger fs-5 font-monospace">
                            Rp {{ number_format($penjualan->piutang->sisa_piutang) }}
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-uppercase fs-7 text-muted fw-semibold d-block mb-1">Tanggal Jatuh Tempo</label>
                        <div class="fw-semibold text-dark">
                            📅 {{ $penjualan->piutang->jatuh_tempo ? $penjualan->piutang->jatuh_tempo->format('d-m-Y') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="pt-2">
                <a href="{{ route('kasir.penjualan.index') }}" class="btn btn-light border text-secondary px-4 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 transition-btn fw-medium">
                    <span>&larr;</span> Kembali ke Data Penjualan
                </a>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header bg-light border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0 fs-6">Detail Produk yang Dibeli</h5>
                    <span class="badge bg-white text-secondary border px-2 py-1.5 font-monospace rounded-2 small">
                        {{ $penjualan->detailPenjualans->count() }} Item
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light border-bottom text-uppercase fs-7 text-muted fw-bold">
                                <tr>
                                    <th scope="col" class="ps-4" width="45%">Produk</th>
                                    <th scope="col" width="20%">Harga</th>
                                    <th scope="col" class="text-center" width="10%">Qty</th>
                                    <th scope="col" class="pe-4 text-end" width="25%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualan->detailPenjualans as $detail)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark fs-6">{{ $detail->produk->nama_produk }}</div>
                                    </td>
                                    <td>
                                        <span class="text-secondary font-monospace small">
                                            Rp {{ number_format($detail->harga) }}
                                        </span>
                                    </td>
                                    <td class="text-center fw-semibold text-dark">
                                        {{ $detail->qty }}
                                    </td>
                                    <td class="pe-4 text-end">
                                        <span class="fw-bold text-dark font-monospace">
                                            Rp {{ number_format($detail->subtotal) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styling Utility */
    .fs-7 {
        font-size: 0.72rem !important;
        letter-spacing: 0.5px;
    }
    .fw-extrabold {
        font-weight: 800 !important;
    }
    .gap-2 { gap: 0.5rem !important; }
    
    /* Pengaturan Baris Tabel */
    .table > :not(caption) > * > * {
        padding: 1.1rem 0.75rem;
    }
    .table tbody tr {
        transition: all 0.2s ease-in-out;
    }
    .table tbody tr:hover {
        background-color: rgba(248, 249, 250, 0.85) !important;
    }

    /* Efek Hover Animasi Tombol */
    .transition-btn {
        transition: all 0.2s ease;
    }
    .transition-btn:hover {
        transform: translateY(-1px);
    }
</style>
@endsection