@extends('layouts.kasir.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">

    <div class="mb-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Detail Data Pelanggan</h3>
            <p class="text-muted small mb-0">Informasi lengkap mengenai profil dan kontak pelanggan terdaftar.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 max-width-container mx-auto">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <tbody>
                        <tr>
                            <th scope="row" class="ps-4 text-muted fw-semibold text-uppercase fs-7 bg-light" width="30%">Nama Lengkap</th>
                            <td class="ps-4 fw-bold text-dark">{{ $pelanggan->nama }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="ps-4 text-muted fw-semibold text-uppercase fs-7 bg-light">No. Telepon / WA</th>
                            <td class="ps-4 text-secondary fw-medium">{{ $pelanggan->telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="ps-4 text-muted fw-semibold text-uppercase fs-7 bg-light">Alamat Rumah</th>
                            <td class="ps-4 text-muted">
                                <div class="style-alamat-text">
                                    {{ $pelanggan->alamat ?? '-' }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center max-width-container mx-auto mt-4 pt-2 border-top">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center gap-2">
            <span>&larr;</span> Kembali
        </a>
        <a href="{{ route('kasir.pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-warning text-white px-3 py-2 rounded-2 shadow-sm">
            Edit Profil
        </a>
    </div>

</div>

<style>
    .fs-7 {
        font-size: 0.72rem;
        letter-spacing: 0.5px;
    }
    .table > :not(caption) > * > * {
        padding: 1.2rem 1rem;
        border-bottom-width: 1px;
    }
    .card {
        overflow: hidden;
    }
    .max-width-container {
        max-width: 800px; /* Membatasi lebar layout agar tetap elegan saat dibuka di monitor lebar */
    }
    .style-alamat-text {
        white-space: pre-line;
        line-height: 1.5;
    }
    .gap-2 { gap: 0.5rem !important; }
    
    /* Optimasi khusus tampilan Mobile (HP) */
    @media (max-width: 576px) {
        .table, tbody, tr, th, td {
            display: block;
            width: 100% !important;
        }
        th.bg-light {
            background-color: #f8f9fa !important;
            padding-top: 0.6rem !important;
            padding-bottom: 0.4rem !important;
            border-bottom: none;
        }
        td {
            padding-top: 0.2rem !important;
            padding-bottom: 0.8rem !important;
        }
    }
</style>
@endsection