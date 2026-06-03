@extends('layouts.kasir.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">
    
    <div class="mb-4 text-center position-relative">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Data Pelanggan</h3>
            <p class="text-muted small mb-0">Kelola dan lihat informasi data pelanggan Anda di sini.</p>
        </div>
        <div class="d-flex justify-content-center justify-content-md-end mt-3 mt-md-0 position-md-absolute top-50 translate-middle-y-md end-0">
            <a href="{{ route('kasir.pelanggan.create') }}" class="btn btn-primary w-100 w-md-auto px-4 py-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-plus-lg"></i> + Tambah Pelanggan
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <span class="me-2">&#10004;</span>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3 d-none d-lg-block mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom text-uppercase fs-7 text-muted fw-semibold">
                        <tr>
                            <th scope="col" class="ps-4" width="8%">No</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">No. Telepon</th>
                            <th scope="col">Alamat</th>
                            <th scope="col" class="pe-4 text-end" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $pelanggan)
                        <tr class="align-middle">
                            <td class="ps-4 fw-medium text-muted">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $pelanggan->nama }}</div>
                            </td>
                            <td>
                                <span class="text-secondary">
                                    {{ $pelanggan->telepon ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="text-muted text-truncate" style="max-width: 350px;">
                                    {{ $pelanggan->alamat ?? '-' }}
                                </div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('kasir.pelanggan.show', $pelanggan) }}" class="btn btn-sm btn-light border text-info px-3 rounded-2">
                                        Detail
                                    </a>
                                    <a href="{{ route('kasir.pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-light border text-warning px-3 rounded-2">
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="py-4">
                                    <span class="fs-2 mb-2 d-block">📂</span>
                                    <h5 class="fw-semibold mb-1 text-dark">Belum ada data pelanggan</h5>
                                    <p class="small text-muted mb-0">Silahkan klik tombol "Tambah Pelanggan" untuk menambahkan data baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-block d-lg-none mb-4">
        @forelse($pelanggans as $pelanggan)
            <div class="card border-0 shadow-sm rounded-3 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2.5">
                        <div>
                            <span class="text-muted small">Pelanggan #{{ $loop->iteration }}</span>
                            <div class="fw-bold text-dark fs-6 mt-0.5">{{ $pelanggan->nama }}</div>
                        </div>
                    </div>

                    <div class="row g-2 small mb-3">
                        <div class="col-12">
                            <span class="text-muted d-block">No. Telepon:</span>
                            <strong class="text-secondary">{{ $pelanggan->telepon ?? '-' }}</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-muted d-block">Alamat:</span>
                            <span class="text-dark d-block text-truncate">{{ $pelanggan->alamat ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="bg-light p-2 rounded-3 d-flex justify-content-end gap-2">
                        <a href="{{ route('kasir.pelanggan.show', $pelanggan) }}" class="btn btn-sm btn-light border text-info px-3 rounded-2 bg-white">
                            Detail
                        </a>
                        <a href="{{ route('kasir.pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-light border text-warning px-3 rounded-2 bg-white">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm rounded-3 p-4 text-center text-muted">
                <div class="py-3">
                    <span class="fs-2 mb-2 d-block">📂</span>
                    <h5 class="fw-semibold mb-1 text-dark">Belum ada data pelanggan</h5>
                    <p class="small text-muted mb-0">Silahkan klik tombol "Tambah Pelanggan" untuk menambahkan data baru.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 pt-2 border-top">
        <div>
            <a href="{{ route('kasir.dashboard') }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center gap-2">
                <span>&larr;</span> Kembali ke Dashboard
            </a>
        </div>
        <div>
            {{-- PENGAMAN OTOMATIS: Hanya render tombol halaman jika controller memakai ->paginate() --}}
            @if(method_exists($pelanggans, 'links'))
                {{ $pelanggans->links() }}
            @endif
        </div>
    </div>

</div>

<style>
    .fs-7 {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .table > :not(caption) > * > * {
        padding: 1.1rem 0.75rem;
    }
    .card {
        overflow: hidden;
    }
    .mb-2.5 { margin-bottom: 0.75rem !important; }
    
    @media (min-width: 768px) {
        .translate-middle-y-md { transform: translateY(-50%) !important; }
        .position-md-absolute { position: absolute !important; }
    }
</style>
@endsection