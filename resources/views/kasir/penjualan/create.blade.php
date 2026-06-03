@extends('layouts.kasir.app')

@section('title', 'Transaksi Penjualan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">

    <div class="mb-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Transaksi Penjualan</h3>
            <p class="text-muted small mb-0">Kelola pencatatan penjualan produk dan pembayaran DP di sini.</p>
        </div>
    </div>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <span class="me-2">&#10006;</span>
            <div>{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-alert="close" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('kasir.penjualan.store') }}" method="POST">
        @csrf

        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-body p-3.5">
                <label class="form-label text-uppercase fs-7 text-muted fw-semibold">Pelanggan</label>
                <select name="pelanggan_id" class="form-select px-3 py-2.5 rounded-2" required>
                    <option value="">Pilih Pelanggan</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3 mb-3">
            <div class="card-body p-0">
                <div class="p-3 border-bottom bg-light rounded-top-3">
                    <h5 class="fw-bold text-dark mb-0 fs-6">Pilih Produk</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="min-width: 600px;">
                        <thead class="table-light text-uppercase fs-7 text-muted fw-semibold border-bottom">
                            <tr>
                                <th scope="col" class="ps-4" width="40%">Produk</th>
                                <th scope="col" width="20%">Harga</th>
                                <th scope="col" width="15%">Stok</th>
                                <th scope="col" class="pe-4" width="25%">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produks as $produk)
                            <tr>
                                <td class="ps-4">
                                    <div class="form-check d-flex align-items-center gap-2 mb-0">
                                        <input type="checkbox" name="produk_id[]" value="{{ $produk->id }}" class="form-check-input style-checkbox">
                                        <label class="form-check-label fw-semibold text-dark">{{ $produk->nama_produk }}</label>
                                    </div>
                                </td>
                                <td class="fw-medium text-secondary">
                                    Rp {{ number_format($produk->harga) }}
                                </td>
                                <td>
                                    <span class="badge {{ $produk->stok > 5 ? 'bg-light text-dark border' : 'bg-danger-subtle text-danger' }} px-2.5 py-1.5 rounded-2">
                                        {{ $produk->stok }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <input type="number" name="qty[]" value="1" min="1" max="{{ $produk->stok }}" class="form-control form-control-sm px-3 py-1.5 rounded-2 max-width-qty">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4">
                <label class="form-label text-uppercase fs-7 text-muted fw-semibold">DP Awal (Uang Muka)</label>
                <div class="input-group max-width-dp">
                    <span class="input-group-text bg-light text-secondary fw-semibold rounded-start-2">Rp</span>
                    <input type="number" name="dp" value="0" min="0" class="form-control px-3 py-2.5 rounded-end-2 fw-semibold text-dark">
                </div>
                <div class="form-text text-muted mt-1 small">* Kosongkan atau isi 0 jika pembayaran tunai langsung lunas (Tanpa DP).</div>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 pt-2">
            <a href="{{ route('kasir.dashboard') }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center justify-content-center gap-2 order-2 order-sm-1">
                <span>&larr;</span> Kembali ke Dashboard
            </a>
            <button type="submit" class="btn btn-success px-4 py-2 rounded-2 shadow-sm fw-semibold order-1 order-sm-2">
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>

<style>
    .fs-7 {
        font-size: 0.72rem;
        letter-spacing: 0.5px;
    }
    .p-3.5 { padding: 1.15rem !important; }
    .py-2.5 { padding-top: 0.65rem !important; padding-bottom: 0.65rem !important; }
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    .style-checkbox {
        width: 1.15rem;
        height: 1.15rem;
        cursor: pointer;
    }
    .max-width-qty {
        max-width: 100px;
    }
    .max-width-dp {
        max-width: 400px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    .gap-2 { gap: 0.5rem !important; }
    .input-group-text {
        border-color: #dee2e6;
    }
</style>
@endsection