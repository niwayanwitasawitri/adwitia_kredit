@extends('layouts.owner.app')

@section('title', 'Laporan Penjualan')

@section('content')

<!-- Header Section: Judul di Tengah -->
<div class="d-flex align-items-center mb-4 position-relative">
    <div style="width: 150px;"></div>
    
    <div class="flex-grow-1 text-center">
        <h3 class="fw-extrabold text-dark mb-0">📈 Laporan Penjualan</h3>
        <p class="text-muted small mt-1">Rekapitulasi seluruh transaksi penjualan toko.</p>
    </div>

    <div style="width: 150px;" class="text-end">
        @if(auth()->user()->hasPermission('print.laporan-penjualan'))
            <a href="{{ route('owner.laporan-penjualan.cetak') }}" class="btn btn-danger shadow-sm px-3 py-2 rounded-pill">
                <small>📄 Cetak PDF</small>
            </a>
        @endif
    </div>
</div>

<!-- Data Table Card -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Kode</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Tanggal</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Pelanggan</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Total</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Status</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualans as $penjualan)
                    <tr>
                        <td class="px-4 fw-bold text-primary">{{ $penjualan->kode_penjualan }}</td>
                        <td class="px-4">{{ $penjualan->tanggal->format('d-m-Y') }}</td>
                        <td class="px-4">{{ $penjualan->pelanggan->nama }}</td>
                        <td class="px-4 font-monospace">Rp {{ number_format($penjualan->total) }}</td>
                        <td class="px-4">
                            <span class="badge {{ $penjualan->status == 'lunas' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} px-3 py-2 rounded-pill">
                                {{ strtoupper($penjualan->status) }}
                            </span>
                        </td>
                        <td class="px-4 text-center">
                            <a href="{{ route('owner.laporan-penjualan.show', $penjualan) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data penjualan.</td>
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