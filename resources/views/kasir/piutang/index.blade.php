@extends('layouts.kasir.app')

@section('title', 'Data Piutang')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-3 d-none d-md-block"></div>
        
        <div class="col-md-6 text-center">
            <div class="py-1">
                <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Data Piutang Pelanggan</h3>
                <p class="text-muted small mb-0">Pantau sisa piutang, status pembayaran, dan riwayat cicilan kasir.</p>
            </div>
        </div>
        
        <div class="col-md-3 text-center text-md-end">
            <span class="badge bg-light text-dark border px-3 py-2 rounded-3 shadow-sm font-monospace fw-semibold d-inline-block">
                Total Transaksi: {{ $piutangs->count() }}
            </span>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-0">
            
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th scope="col" class="ps-4 text-uppercase fs-7 text-muted fw-bold" width="20%">Kode Nota</th>
                            <th scope="col" class="text-uppercase fs-7 text-muted fw-bold" width="25%">Nama Pelanggan</th>
                            <th scope="col" class="text-uppercase fs-7 text-muted fw-bold" width="25%">Sisa Piutang</th>
                            <th scope="col" class="text-uppercase fs-7 text-muted fw-bold text-center" width="15%">Status</th>
                            <th scope="col" class="pe-4 text-uppercase fs-7 text-muted fw-bold text-end" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($piutangs as $piutang)
                        <tr>
                            <td class="ps-4">
                                <span class="font-monospace fw-bold text-dark fs-7 bg-white px-2 py-1 rounded border">
                                    {{ $piutang->penjualan->kode_penjualan }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $piutang->penjualan->pelanggan->nama }}</div>
                            </td>
                            <td>
                                <span class="fw-bold text-danger fs-6">
                                    Rp {{ number_format($piutang->sisa_piutang) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if(strtoupper($piutang->status) == 'LUNAS')
                                    <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-2 fw-semibold fs-7 border border-success-subtle">
                                        ✓ LUNAS
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5 rounded-2 fw-semibold fs-7 border border-danger-subtle">
                                        ✗ BELUM LUNAS
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('kasir.piutang.show', $piutang) }}" class="btn btn-sm btn-outline-primary px-3 py-1.5 rounded-2 shadow-sm fw-medium transition-btn">
                                    Detail Data
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="fs-4 mb-2">📂</div>
                                <div class="small fw-medium">Belum ada data piutang saat ini.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-md-none p-3">
                @forelse($piutangs as $piutang)
                <div class="card border border-light-subtle shadow-sm rounded-3 mb-3 overflow-hidden transition-card">
                    <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center py-2.5 px-3">
                        <span class="font-monospace fw-bold text-secondary small">
                            #{{ $piutang->penjualan->kode_penjualan }}
                        </span>
                        @if(strtoupper($piutang->status) == 'LUNAS')
                            <span class="badge bg-success-subtle text-success px-2 py-1 rounded-2 font-size-11">LUNAS</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-2 font-size-11">BELUM LUNAS</span>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-2">
                            <small class="text-muted d-block text-uppercase font-size-11 fw-semibold">Pelanggan</small>
                            <span class="fw-bold text-dark">{{ $piutang->penjualan->pelanggan->nama }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block text-uppercase font-size-11 fw-semibold">Sisa Piutang</small>
                            <span class="fw-bold text-danger fs-5">Rp {{ number_format($piutang->sisa_piutang) }}</span>
                        </div>
                        <div class="d-grid border-top pt-2">
                            <a href="{{ route('kasir.piutang.show', $piutang) }}" class="btn btn-primary btn-sm py-2 rounded-2 fw-medium shadow-sm">
                                Lihat Detail Piutang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <div class="fs-4 mb-2">📂</div>
                    <div class="small fw-medium">Belum ada data piutang saat ini.</div>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <div class="d-flex justify-content-start pt-2">
        <a href="{{ route('kasir.dashboard') }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center gap-2">
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
    .font-size-11 {
        font-size: 11px !important;
    }
    .py-2.5 { 
        padding-top: 0.65rem !important; 
        padding-bottom: 0.65rem !important; 
    }
    .gap-2 { gap: 0.5rem !important; }
    
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
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.15) !important;
    }

    /* Efek Angkat Kartu di Mobile */
    .transition-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .transition-card:active {
        transform: scale(0.98);
    }
</style>
@endsection