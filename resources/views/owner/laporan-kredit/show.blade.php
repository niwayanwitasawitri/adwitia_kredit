@extends('layouts.owner.app')

@section('title', 'Detail Kredit')

@section('content')

<div class="row align-items-center mb-5 border-bottom pb-4">
    <div class="col-3">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-3 py-2">
            <small>← Kembali</small>
        </a>
    </div>

    <div class="col-6 text-center">
        <h2 class="fw-bold text-dark text-uppercase mb-2">Laporan Detail Kredit</h2>
        <p class="text-muted small mb-0">Nomor Transaksi: <strong>{{ $penjualan->kode_penjualan }}</strong></p>
    </div>

    <div class="col-3 text-end">
        <a href="{{ route('owner.laporan-kredit.index') }}" class="btn btn-danger shadow-sm px-3 py-2 rounded-pill">
            <small>📄 Cetak PDF</small>
        </a>
    </div>
</div>

<div class="row g-4">
    </div>