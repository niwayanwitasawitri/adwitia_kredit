@extends('layouts.owner.app')

@section('title', 'Laporan Stok')

@section('content')

<div class="d-flex align-items-center mb-4 position-relative">
    <div style="width: 150px;"></div>
    
    <div class="flex-grow-1 text-center">
        <h3 class="fw-extrabold text-dark mb-0">📦 Laporan Stok</h3>
        <p class="text-muted small mt-1">Audit inventaris dan ketersediaan produk saat ini.</p>
    </div>

    <div style="width: 150px;" class="text-end">
        <a href="{{ route('owner.laporan-stok.cetak') }}" class="btn btn-danger shadow-sm px-3 py-2 rounded-pill">
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
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Kategori</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Nama Produk</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary">Harga</th>
                        <th class="px-4 py-3 text-uppercase fs-7 text-secondary text-center">Stok Tersedia</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                    <tr>
                        <td class="px-4 text-muted">{{ $produk->kategori->nama_kategori }}</td>
                        <td class="px-4 fw-bold text-dark">{{ $produk->nama_produk }}</td>
                        <td class="px-4 font-monospace">Rp {{ number_format($produk->harga) }}</td>
                        <td class="px-4 text-center">
                            <span class="badge {{ $produk->stok < 10 ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary' }} px-3 py-2 rounded-pill font-monospace">
                                {{ $produk->stok }} Unit
                                @if($produk->stok < 10) <small>⚠️</small> @endif
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Data stok tidak tersedia.</td>
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
    .badge { font-weight: 700; min-width: 80px; }
</style>

@endsection