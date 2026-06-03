@extends('layouts.kasir.app')

@section('title', 'Data Penjualan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">

    <div class="mb-4 text-center position-relative">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Data Penjualan</h3>
            <p class="text-muted small mb-0">Pantau transaksi penjualan, uang muka (DP), dan denda piutang otomatis.</p>
        </div>
        <div class="d-flex justify-content-center justify-content-md-end mt-3 mt-md-0 position-md-absolute top-50 translate-middle-y-md end-0">
            <a href="{{ route('kasir.penjualan.create') }}" class="btn btn-primary w-100 w-md-auto px-4 py-2 rounded-3 shadow-sm">
                + Transaksi Baru
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
                            <th scope="col" class="ps-4">Kode</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Informasi DP</th> 
                            <th scope="col">Bunga Piutang</th>
                            <th scope="col">Total Tagihan</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="pe-4 text-end" width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualans as $penjualan)
                            @php
                                $infoBunga = $penjualan->infoBungaOtomatis();
                                $nominalDp = 0;
                                if ($penjualan->status != 'lunas' && $penjualan->piutang) {
                                    $nominalDp = $penjualan->total - $penjualan->piutang->sisa_piutang;
                                }
                            @endphp
                        <tr class="align-middle">
                            <td class="ps-4 fw-bold text-secondary">#{{ $penjualan->kode_penjualan }}</td>
                            <td><span class="text-muted small">{{ $penjualan->tanggal->format('d-m-Y') }}</span></td>
                            <td><div class="fw-semibold text-dark">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</div></td>
                            <td>
                                @if($penjualan->status == 'lunas')
                                    <span class="badge bg-light text-secondary border px-2 py-1">Lunas / Cash</span>
                                @else
                                    @if($nominalDp > 0)
                                        <span class="badge bg-success-subtle text-success px-2 py-1 mb-1 fw-medium">&#10003; Bayar DP</span>
                                        <div class="text-muted small" style="font-size: 11px;">Masuk: Rp {{ number_format($nominalDp, 0, ',', '.') }}</div>
                                    @else
                                        <span class="badge bg-dark-subtle text-dark px-2 py-1 mb-1 fw-medium">&#10007; Tanpa DP (0)</span>
                                        <div class="text-danger small" style="font-size: 11px;">Utang Penuh</div>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($penjualan->status != 'lunas')
                                    <div class="fw-bold text-danger">{{ number_format($infoBunga['persen_bunga'], 2, ',', '.') }}%</div>
                                    <small class="text-muted" style="font-size: 11px;">(+Rp {{ number_format($infoBunga['nominal_bunga'], 0, ',', '.') }})</small>
                                    <span class="d-block text-secondary text-truncate style-status mt-1">{{ $infoBunga['status_durasi'] }}</span>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                @if($penjualan->status != 'lunas')
                                    <div class="fw-bold text-primary mb-1">Rp {{ number_format($infoBunga['total_transaksi_akhir'], 0, ',', '.') }}</div>
                                    <div style="font-size: 11px;" class="text-muted">Sisa Piutang: <span class="text-danger fw-semibold">Rp {{ number_format($infoBunga['sisa_tagihan_piutang'], 0, ',', '.') }}</span></div>
                                @else
                                    <div class="fw-bold text-success">Rp {{ number_format($penjualan->total, 0, ',', '.') }}</div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $penjualan->status == 'lunas' ? 'success' : 'danger' }}-subtle text-{{ $penjualan->status == 'lunas' ? 'success' : 'danger' }} px-3 py-2 rounded-2 fw-medium">
                                    {{ $penjualan->status == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('kasir.penjualan.show', $penjualan) }}" class="btn btn-sm btn-light border text-info px-3 rounded-2">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-block d-lg-none mb-4">
        @foreach($penjualans as $penjualan)
            @php
                $infoBunga = $penjualan->infoBungaOtomatis();
                $nominalDp = 0;
                if ($penjualan->status != 'lunas' && $penjualan->piutang) {
                    $nominalDp = $penjualan->total - $penjualan->piutang->sisa_piutang;
                }
            @endphp
            <div class="card border-0 shadow-sm rounded-3 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2.5">
                        <div>
                            <span class="fw-bold text-secondary">#{{ $penjualan->kode_penjualan }}</span>
                            <div class="text-muted style-text-date">{{ $penjualan->tanggal->format('d-m-Y') }}</div>
                        </div>
                        <span class="badge bg-{{ $penjualan->status == 'lunas' ? 'success' : 'danger' }}-subtle text-{{ $penjualan->status == 'lunas' ? 'success' : 'danger' }} px-2.5 py-1.5 rounded-2 fw-medium small">
                            {{ $penjualan->status == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                        </span>
                    </div>

                    <div class="row g-2 small mb-3">
                        <div class="col-6">
                            <span class="text-muted d-block">Pelanggan:</span>
                            <strong class="text-dark">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</strong>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-muted d-block">Informasi DP:</span>
                            @if($penjualan->status == 'lunas')
                                <span class="text-secondary fw-semibold">Lunas / Cash</span>
                            @else
                                @if($nominalDp > 0)
                                    <span class="text-success fw-semibold">DP: Rp {{ number_format($nominalDp, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-dark fw-semibold">Tanpa DP (0)</span>
                                @endif
                            @endif
                        </div>
                        
                        @if($penjualan->status != 'lunas')
                        <div class="col-6 mt-2">
                            <span class="text-muted d-block">Bunga Piutang ({{ $infoBunga['status_durasi'] }}):</span>
                            <strong class="text-danger">{{ number_format($infoBunga['persen_bunga'], 2, ',', '.') }}% (+Rp {{ number_format($infoBunga['nominal_bunga'], 0, ',', '.') }})</strong>
                        </div>
                        @endif
                    </div>

                    <div class="bg-light p-2.5 rounded-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small d-block" style="font-size: 11px;">Total Wajib Bayar:</span>
                            @if($penjualan->status != 'lunas')
                                <span class="fw-bold text-primary">Rp {{ number_format($infoBunga['total_transaksi_akhir'], 0, ',', '.') }}</span>
                                <div style="font-size: 10px;" class="text-muted">Sisa: <span class="text-danger fw-semibold">Rp {{ number_format($infoBunga['sisa_tagihan_piutang'], 0, ',', '.') }}</span></div>
                            @else
                                <span class="fw-bold text-success">Rp {{ number_format($penjualan->total, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <a href="{{ route('kasir.penjualan.show', $penjualan) }}" class="btn btn-sm btn-primary px-3 rounded-2">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 pt-2 border-top">
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center gap-2">
                <span>&larr;</span> Kembali
            </a>
        </div>
        <div>
            {{ $penjualans->links() }}
        </div>
    </div>

</div>

<style>
    .fs-7 { font-size: 0.72rem; letter-spacing: 0.5px; }
    .table > :not(caption) > * > * { padding: 1.1rem 0.75rem; }
    .style-status {
        font-size: 10px;
        background-color: #f8f9fa;
        padding: 2px 6px;
        border-radius: 4px;
        display: inline-block;
        border: 1px solid #e9ecef;
    }
    .style-text-date { font-size: 11px; }
    .card { overflow: hidden; }
    .gap-2 { gap: 0.5rem !important; }
    .mb-2.5 { margin-bottom: 0.75rem !important; }
    .p-2.5 { padding: 0.65rem !important; }
    
    /* Utilitas tambahan posisi absolut untuk kerapian layout desktop */
    @media (min-width: 768px) {
        .translate-middle-y-md { transform: translateY(-50%) !important; }
        .position-md-absolute { position: absolute !important; }
    }
</style>
@endsection