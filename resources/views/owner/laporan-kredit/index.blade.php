@extends('layouts.owner.app')

@section('title', 'Laporan Kredit')

@section('content')

<!-- Header Section: Judul di Tengah -->
<div class="d-flex align-items-center mb-4 position-relative">
    <!-- Spacer untuk menyeimbangkan posisi judul -->
    <div style="width: 150px;"></div> 
    
    <div class="flex-grow-1 text-center">
        <h3 class="fw-extrabold text-dark mb-0">📋 Laporan Kredit</h3>
        <p class="text-muted small mt-1">Daftar transaksi kredit pelanggan dan sisa piutang.</p>
    </div>

    <!-- Tombol Cetak di sisi kanan -->
    <div style="width: 150px;" class="text-end">
        <a href="{{ route('owner.laporan-kredit.cetak') }}" class="btn btn-danger shadow-sm px-3 py-2 rounded-pill">
            <small>📄 Cetak PDF</small>
        </a>
    </div>
</div>

<!-- Data Table Card -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Kode Transaksi</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Pelanggan</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Total Tagihan</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Sisa Piutang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualans as $penjualan)
                    <tr>
                        <td class="px-4 fw-bold text-primary">{{ $penjualan->kode_penjualan }}</td>
                        <td class="px-4">{{ $penjualan->pelanggan->nama }}</td>
                        <td class="px-4 font-monospace">Rp {{ number_format($penjualan->total) }}</td>
                        <td class="px-4">
                            <span class="badge {{ ($penjualan->piutang->sisa_piutang > 0) ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' }} px-3 py-2 rounded-pill font-monospace">
                                Rp {{ number_format($penjualan->piutang->sisa_piutang) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Data kredit tidak ditemukan.</td>
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
    .badge { font-weight: 700; }
</style>

@endsection