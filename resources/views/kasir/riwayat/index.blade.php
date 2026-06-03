@extends('layouts.kasir.app')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-3 order-2 order-md-1 text-center text-md-start">
            <span class="badge bg-light text-dark border px-3 py-2 rounded-3 shadow-sm font-monospace fw-semibold d-inline-block">
                Total Riwayat: {{ $penjualans->count() }} Transaksi
            </span>
        </div>
        
        <div class="col-md-6 order-1 text-center">
            <div class="py-1">
                <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Riwayat Penjualan Kasir</h3>
                <p class="text-muted small mb-0">Arsip seluruh rekam jejak nota transaksi penjualan barang lunas maupun piutang.</p>
            </div>
        </div>
        
        <div class="col-md-3 order-3 text-center text-md-end">
            @if(auth()->user()->hasPermission('print.riwayat-penjualan'))
                <a href="{{ route('kasir.riwayat.cetak') }}" class="btn btn-danger px-4 py-2 rounded-3 shadow-sm fw-medium transition-btn text-white w-100 w-md-auto">
                    📄 Cetak PDF
                </a>
            @endif
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-0">
            
            <div class="table-responsive d-none d-lg-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom text-uppercase fs-7 text-muted fw-bold">
                        <tr>
                            <th scope="col" class="ps-4" width="20%">Kode Penjualan</th>
                            <th scope="col" width="30%">Nama Pelanggan</th>
                            <th scope="col" width="25%">Total Belanja</th>
                            <th scope="col" class="text-center" width="15%">Status</th>
                            <th scope="col" class="pe-4 text-end" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualans as $penjualan)
                        <tr>
                            <td class="ps-4">
                                <span class="font-monospace fw-bold text-dark bg-light px-2.5 py-1.5 rounded border small">
                                    {{ $penjualan->kode_penjualan }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</div>
                            </td>
                            <td>
                                <span class="fw-extrabold text-dark font-monospace">
                                    Rp {{ number_format($penjualan->total) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if(trim(strtoupper($penjualan->status)) == 'LUNAS')
                                    <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-2 fw-bold font-size-11 border border-success-subtle d-inline-block w-100 max-w-110">
                                        ✓ LUNAS
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5 rounded-2 fw-bold font-size-11 border border-danger-subtle d-inline-block w-100 max-w-110">
                                        ✗ {{ strtoupper($penjualan->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('kasir.riwayat.show', $penjualan) }}" class="btn btn-sm btn-outline-info px-3 py-1.5 rounded-2 fw-medium transition-btn">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="fs-4 mb-2">📂</div>
                                <div class="small fw-medium">Belum ada rekaman data riwayat penjualan.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-lg-none p-3">
                @forelse($penjualans as $penjualan)
                <div class="card border border-light-subtle shadow-sm rounded-3 mb-3 overflow-hidden transition-card">
                    <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center py-2.5 px-3">
                        <span class="font-monospace fw-bold text-secondary">
                            #{{ $penjualan->kode_penjualan }}
                        </span>
                        @if(trim(strtoupper($penjualan->status)) == 'LUNAS')
                            <span class="badge bg-success-subtle text-success px-2.5 py-1 rounded-2 font-size-11 border border-success-subtle fw-bold">LUNAS</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-2.5 py-1 rounded-2 font-size-11 border border-danger-subtle fw-bold">{{ strtoupper($penjualan->status) }}</span>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <div class="row align-items-center g-2 mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block small mb-0.5">Pelanggan</small>
                                <span class="fw-bold text-dark fs-6">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</span>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted d-block small mb-0.5">Total Belanja</small>
                                <span class="fw-extrabold text-primary font-monospace fs-6">Rp {{ number_format($penjualan->total) }}</span>
                            </div>
                        </div>
                        <div class="d-grid border-top pt-2">
                            <a href="{{ route('kasir.riwayat.show', $penjualan) }}" class="btn btn-primary btn-sm py-2 rounded-2 fw-medium shadow-sm">
                                Lihat Detail Riwayat
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted bg-white rounded-3">
                    <div class="fs-4 mb-2">📂</div>
                    <div class="small fw-medium">Belum ada rekaman data riwayat penjualan.</div>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <div class="d-flex justify-content-start pt-2">
        <a href="{{ route('kasir.dashboard') }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center gap-2 transition-btn fw-medium">
            <span>&larr;</span> Kembali ke Dashboard
        </a>
    </div>

</div>

<style>
    /* Utility & Typografi Custom */
    .fs-7 {
        font-size: 0.72rem !important;
        letter-spacing: 0.5px;
    }
    .fw-extrabold {
        font-weight: 800 !important;
    }
    .font-size-11 {
        font-size: 11px !important;
    }
    .max-w-110 {
        max-width: 120px;
    }
    .py-2.5 { 
        padding-top: 0.65rem !important; 
        padding-bottom: 0.65rem !important; 
    }
    .gap-2 { gap: 0.5rem !important; }
    .mb-0.5 { margin-bottom: 0.15rem !important; }
    
    /* Pengaturan Baris Tabel Desktop */
    .table > :not(caption) > * > * {
        padding: 1.1rem 0.75rem;
    }
    .table tbody tr {
        transition: all 0.2s ease-in-out;
    }
    .table tbody tr:hover {
        background-color: rgba(248, 249, 250, 0.85) !important;
    }

    /* Transisi Halus pada Tombol */
    .transition-btn {
        transition: all 0.2s ease;
    }
    .transition-btn:hover {
        transform: translateY(-1px);
    }

    /* Efek Interaksi Kartu Mobile */
    .transition-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .transition-card:active {
        transform: scale(0.98);
    }
</style>
@endsection