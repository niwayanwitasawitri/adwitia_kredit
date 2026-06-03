@extends('layouts.owner.app')

@section('title', 'Laporan Piutang')

@section('content')

<div class="d-flex align-items-center mb-4 position-relative">
    <div style="width: 150px;"></div>
    
    <div class="flex-grow-1 text-center">
        <h3 class="fw-extrabold text-dark mb-0">🚨 Laporan Piutang</h3>
        <p class="text-muted small mt-1">Daftar pemantauan sisa piutang pelanggan.</p>
    </div>

    <div style="width: 150px;" class="text-end">
        <a href="{{ route('owner.laporan-piutang.cetak') }}" class="btn btn-danger shadow-sm px-3 py-2 rounded-pill">
            <small>📄 Cetak PDF</small>
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Kode Transaksi</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Pelanggan</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Total Piutang</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Sisa Tagihan</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($piutangs as $piutang)
                    <tr>
                        <td class="px-4 fw-bold text-primary">{{ $piutang->penjualan->kode_penjualan }}</td>
                        <td class="px-4">{{ $piutang->penjualan->pelanggan->nama }}</td>
                        <td class="px-4 font-monospace">Rp {{ number_format($piutang->total_piutang) }}</td>
                        <td class="px-4 font-monospace fw-bold text-danger">Rp {{ number_format($piutang->sisa_piutang) }}</td>
                        <td class="px-4 text-center">
                            <span class="badge {{ strtolower($piutang->status) == 'lunas' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} px-3 py-2 rounded-pill">
                                {{ strtoupper($piutang->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Data piutang tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .fs-7 { font-size: 0.75rem; letter-spacing: 0.8px; }
    .table thead th { border-bottom: 2px solid #f8f9fa; }
    .table tbody tr:hover { background-color: #f9fafb; }
</style>

@endsection