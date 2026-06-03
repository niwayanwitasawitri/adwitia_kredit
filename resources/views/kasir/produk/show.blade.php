@extends('layouts.kasir.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Header Section (Judul di Tengah Atas) -->
    <div class="mb-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Detail Informasi Produk</h3>
            <p class="text-muted small mb-0">Informasi spesifikasi barang, kategori, harga jual, dan sisa stok gudang.</p>
        </div>
    </div>

    <!-- Main Card Container -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden max-width-card mx-auto">
        <div class="card-header bg-light border-0 py-3 px-4">
            <h5 class="fw-bold text-dark mb-0 fs-6">Spesifikasi Produk</h5>
        </div>
        
        <div class="card-body p-4">
            
            <!-- LIST DETAIL RATA KIRI-KANAN (SEJAJAR SEMPURNA) -->
            
            <!-- 1. KATEGORI -->
            <div class="row py-3 border-bottom align-items-center g-2">
                <div class="col-sm-3">
                    <span class="text-muted text-uppercase fs-7 fw-bold">Kategori</span>
                </div>
                <div class="col-sm-9">
                    <span class="badge bg-light text-secondary border px-2.5 py-1.5 rounded-2 fw-semibold">
                        {{ $produk->kategori->nama_kategori }}
                    </span>
                </div>
            </div>

            <!-- 2. PRODUK -->
            <div class="row py-3 border-bottom align-items-center g-2">
                <div class="col-sm-3">
                    <span class="text-muted text-uppercase fs-7 fw-bold">Produk</span>
                </div>
                <div class="col-sm-9">
                    <span class="fw-bold text-dark fs-6">{{ $produk->nama_produk }}</span>
                </div>
            </div>

            <!-- 3. HARGA -->
            <div class="row py-3 border-bottom align-items-center g-2">
                <div class="col-sm-3">
                    <span class="text-muted text-uppercase fs-7 fw-bold">Harga</span>
                </div>
                <div class="col-sm-9">
                    <span class="fw-extrabold text-success fs-5 font-monospace">
                        Rp {{ number_format($produk->harga) }}
                    </span>
                </div>
            </div>

            <!-- 4. STOK -->
            <div class="row py-3 border-bottom align-items-center g-2">
                <div class="col-sm-3">
                    <span class="text-muted text-uppercase fs-7 fw-bold">Stok</span>
                </div>
                <div class="col-sm-9">
                    @if($produk->stok > 5)
                        <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-2 fw-bold font-size-11 border border-success-subtle">
                            📦 {{ $produk->stok }} Unit Tersedia
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5 rounded-2 fw-bold font-size-11 border border-danger-subtle">
                            ⚠️ Sisa {{ $produk->stok }} Unit
                        </span>
                    @endif
                </div>
            </div>

            <!-- 5. DESKRIPSI -->
            <div class="row py-3 g-2">
                <div class="col-sm-3 pt-sm-1">
                    <span class="text-muted text-uppercase fs-7 fw-bold">Deskripsi</span>
                </div>
                <div class="col-sm-9">
                    <div class="p-3 bg-light rounded-3 text-secondary border border-light-subtle small style-description">
                        {{ $produk->deskripsi ?? 'Tidak ada deskripsi tambahan untuk produk ini.' }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- FITUR TOMBOL KEMBALI -->
    <div class="d-flex justify-content-start max-width-card mx-auto pt-3">
        <a href="{{ route('kasir.produk.index') }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center gap-2 transition-btn fw-medium">
            <span>&larr;</span> Kembali ke Data Produk
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
    .gap-2 { gap: 0.5rem !important; }
    
    /* Lebar Maksimal Kontainer Detail Agar Terpusat Indah */
    .max-width-card {
        max-width: 750px;
    }

    /* Box Deskripsi */
    .style-description {
        line-height: 1.6;
        white-space: pre-line;
    }

    /* Transisi Halus pada Tombol */
    .transition-btn {
        transition: all 0.2s ease;
    }
    .transition-btn:hover {
        transform: translateY(-1px);
        background-color: #f8f9fa;
    }
</style>
@endsection