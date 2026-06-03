@extends('layouts.kasir.app')

@section('title', 'Data Produk')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Header Section (Judul di Tengah & Jumlah di Pojok Kanan) -->
    <div class="row align-items-center mb-4 g-3">
        <!-- Spacer Kiri agar Judul Tetap Presisi di Tengah Pada Layar Desktop -->
        <div class="col-md-3 d-none d-md-block"></div>
        
        <!-- Judul Berada di Tengah -->
        <div class="col-md-6 text-center">
            <div class="py-1">
                <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Data Stok Produk</h3>
                <p class="text-muted small mb-0">Pantau ketersediaan stok, kategori, dan harga jual produk kasir.</p>
            </div>
        </div>
        
        <!-- Fitur Jumlah Produk Berada di Pojok Kanan Atas -->
        <div class="col-md-3 text-center text-md-end">
            <span class="badge bg-light text-dark border px-3 py-2 rounded-3 shadow-sm font-monospace fw-semibold d-inline-block">
                Total Produk: {{ $produks->count() }}
            </span>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-0">
            
            <!-- TAMPILAN DESKTOP (Tabel Modern & Elegan) -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th scope="col" class="ps-4 text-uppercase fs-7 text-muted fw-bold" width="8%">No</th>
                            <th scope="col" class="text-uppercase fs-7 text-muted fw-bold" width="22%">Kategori</th>
                            <th scope="col" class="text-uppercase fs-7 text-muted fw-bold" width="30%">Nama Produk</th>
                            <th scope="col" class="text-uppercase fs-7 text-muted fw-bold" width="20%">Harga Jual</th>
                            <th scope="col" class="text-uppercase fs-7 text-muted fw-bold text-center" width="10%">Stok</th>
                            <th scope="col" class="pe-4 text-uppercase fs-7 text-muted fw-bold text-end" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $produk)
                        <tr>
                            <td class="ps-4">
                                <span class="text-secondary font-monospace fw-medium">{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border px-2.5 py-1.5 rounded-2 fw-medium fs-7">
                                    {{ $produk->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6">{{ $produk->nama_produk }}</div>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">
                                    Rp {{ number_format($produk->harga) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($produk->stok > 5)
                                    <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-2 fw-semibold border border-success-subtle">
                                        {{ $produk->stok }}
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5 rounded-2 fw-semibold border border-danger-subtle">
                                        {{ $produk->stok }} <small class="fs-8">Tipis</small>
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('kasir.produk.show', $produk) }}" class="btn btn-sm btn-outline-primary px-3 py-1.5 rounded-2 shadow-sm fw-medium transition-btn">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <div class="fs-4 mb-2">📦</div>
                                <div class="small fw-medium">Belum ada data produk di database.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TAMPILAN MOBILE (Card Layout Otomatis Aktif di Layar HP) -->
            <div class="d-md-none p-3">
                @forelse($produks as $produk)
                <div class="card border border-light-subtle shadow-sm rounded-3 mb-3 overflow-hidden transition-card">
                    <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center py-2.5 px-3">
                        <span class="badge bg-white text-secondary border px-2 py-1 rounded-2 font-size-11 fw-medium">
                            {{ $produk->kategori->nama_kategori }}
                        </span>
                        @if($produk->stok > 5)
                            <span class="badge bg-success-subtle text-success px-2 py-1 rounded-2 font-size-11">Stok: {{ $produk->stok }}</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-2 font-size-11">Stok Sisa: {{ $produk->stok }}</span>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <div class="mb-1">
                            <span class="fw-bold text-dark fs-6">{{ $produk->nama_produk }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-extrabold text-success fs-5">Rp {{ number_format($produk->harga) }}</span>
                        </div>
                        <div class="d-grid border-top pt-2">
                            <a href="{{ route('kasir.produk.show', $produk) }}" class="btn btn-primary btn-sm py-2 rounded-2 fw-medium shadow-sm">
                                Lihat Detail Produk
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <div class="fs-4 mb-2">📦</div>
                    <div class="small fw-medium">Belum ada data produk di database.</div>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- FITUR TOMBOL KEMBALI: Posisi di Kiri Bawah Luar Card -->
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
    .fs-8 {
        font-size: 10px !important;
    }
    .fw-extrabold {
        font-weight: 800 !important;
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