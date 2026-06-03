@extends('layouts.kasir.app')

@section('title', 'Detail Piutang')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Header Section (Judul di Tengah Atas) -->
    <div class="mb-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Detail Piutang Pelanggan</h3>
            <p class="text-muted small mb-0">Informasi lengkap mengenai tagihan, cicilan, dan riwayat mutasi pembayaran.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- KOLOM KIRI: Informasi Utama Piutang & Form Pembayaran -->
        <div class="col-lg-5">
            <!-- Ringkasan Invoice Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <div>
                            <small class="text-muted text-uppercase d-block fs-7 fw-bold">Kode Nota</small>
                            <span class="font-monospace fw-bold text-dark fs-5">#{{ $piutang->penjualan->kode_penjualan }}</span>
                        </div>
                        <div>
                            @if($piutang->status == 'belum_lunas')
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-3 border border-danger-subtle fw-semibold fs-7">
                                    ✗ BELUM LUNAS
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-3 border border-success-subtle fw-semibold fs-7">
                                    ✓ LUNAS
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Detail List Row -->
                    <div class="mb-3">
                        <label class="form-label text-uppercase fs-7 text-muted fw-semibold d-block mb-1">Nama Pelanggan</label>
                        <div class="fw-bold text-dark fs-6">{{ $piutang->penjualan->pelanggan->nama }}</div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-uppercase fs-7 text-muted fw-semibold d-block mb-1">Total Sisa Piutang</label>
                        <div class="fw-extrabold text-danger fs-3 font-monospace">
                            Rp {{ number_format($piutang->sisa_piutang) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Bayar Cicilan (Hanya Tampil Jika Belum Lunas) -->
            @if($piutang->status == 'belum_lunas')
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-light border-0 py-3 px-4">
                    <h5 class="fw-bold text-dark mb-0 fs-6">Input Pembayaran Cicilan</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('kasir.piutang.bayar', $piutang) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-uppercase fs-7 text-muted fw-bold mb-2">Jumlah Nominal Bayar (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary fw-bold border-end-0 px-3">Rp</span>
                                <input type="number" 
                                       name="jumlah_bayar" 
                                       class="form-control border-start-0 px-3 py-2.5 fw-bold text-dark" 
                                       max="{{ $piutang->sisa_piutang }}" 
                                       placeholder="0" 
                                       required>
                            </div>
                            <div class="form-text text-muted mt-2 small">* Maksimal pembayaran tidak boleh melebihi sisa piutang.</div>
                        </div>

                        <!-- Tombol Aksi & Navigasi Kembali Berdampingan -->
                        <div class="d-flex align-items-center justify-content-between gap-2 pt-2">
                            <a href="{{ route('kasir.piutang.index') }}" class="btn btn-light border text-secondary px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 transition-btn">
                                <span>&larr;</span> Kembali
                            </a>
                            <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm fw-bold">
                                Proses Bayar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <!-- Tombol Kembali Khusus Jika Status Sudah Lunas -->
            <div class="d-flex justify-content-start">
                <a href="{{ route('kasir.piutang.index') }}" class="btn btn-light border text-secondary px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 transition-btn">
                    <span>&larr;</span> Kembali ke Data Piutang
                </a>
            </div>
            @endif
        </div>

        <!-- KOLOM KANAN: Tabel Riwayat Pembayaran -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-header bg-light border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0 fs-6">Riwayat Pembayaran</h5>
                    <span class="badge bg-white text-secondary border px-2 py-1.5 font-monospace rounded-2 small">
                        {{ $piutang->penjualan->pembayarans->count() }} Record
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <th scope="col" class="ps-4 text-uppercase fs-7 text-muted fw-bold" width="30%">Tanggal</th>
                                    <th scope="col" class="text-uppercase fs-7 text-muted fw-bold" width="35%">Jumlah Bayar</th>
                                    <th scope="col" class="pe-4 text-uppercase fs-7 text-muted fw-bold" width="35%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($piutang->penjualan->pembayarans as $bayar)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-semibold text-dark small">{{ $bayar->tanggal_bayar }}</div>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success font-monospace">
                                            + Rp {{ number_format($bayar->jumlah_bayar) }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-secondary small">
                                        {{ $bayar->keterangan ?? '-' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <div class="fs-4 mb-2">📜</div>
                                        <div class="small fw-medium">Belum ada rekaman cicilan pembayaran.</div>
                                    </td>
                                </tr>
                                @endforelse
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
        padding: 1rem 0.75rem;
    }
    
    /* Modifikasi Form Input */
    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    .input-group-text {
        border-color: #dee2e6;
    }

    /* Efek Hover Animasi Tombol */
    .transition-btn {
        transition: all 0.2s ease;
    }
    .transition-btn:hover {
        transform: translateY(-1px);
        background-color: #f8f9fa;
    }
</style>
@endsection