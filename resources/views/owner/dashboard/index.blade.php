@extends('layouts.owner.app')

@section('title', 'Dashboard Owner')

@section('content')

<!-- Header Terpusat -->
<div class="text-center mb-5 mt-3">
    <h2 class="fw-extrabold text-dark mb-2">📊 Owner Dasboard</h2>
    <p class="text-secondary">Laporan ringkas performa dan keuangan bisnis Anda.</p>
</div>

<!-- Statistik Utama (Gradient Cards) -->
<div class="row g-4 mb-4">
    @php
        $stats = [
            ['title' => 'Total Produk', 'value' => $data['totalProduk'], 'icon' => '📦', 'color' => 'linear-gradient(135deg, #4f46e5 0%, #3730a3 100%)'],
            ['title' => 'Total Pelanggan', 'value' => $data['totalPelanggan'], 'icon' => '👥', 'color' => 'linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%)'],
            ['title' => 'Total Penjualan', 'value' => $data['totalPenjualan'], 'icon' => '🛒', 'color' => 'linear-gradient(135deg, #0891b2 0%, #155e75 100%)'],
            ['title' => 'Total Piutang', 'value' => 'Rp ' . number_format($data['totalPiutang']), 'icon' => '💰', 'color' => 'linear-gradient(135deg, #d97706 0%, #92400e 100%)'],
        ];
    @endphp

    @foreach($stats as $stat)
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card border-0 shadow-lg text-white rounded-4 overflow-hidden stat-card" style="background: {{ $stat['color'] }};">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 opacity-75 text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">{{ $stat['title'] }}</p>
                        <h3 class="fw-bold mb-0">{{ $stat['value'] }}</h3>
                    </div>
                    <div class="fs-2 opacity-50">{{ $stat['icon'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Statistik Piutang (Accent Cards) -->
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 border-start border-success border-5 h-100">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">✓</div>
                <div>
                    <h6 class="text-muted text-uppercase mb-1 fw-bold fs-7">Piutang Lunas</h6>
                    <h3 class="text-dark fw-extrabold mb-0">{{ $data['piutangLunas'] }} Transaksi</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 border-start border-warning border-5 h-100">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="bg-warning-subtle text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">⏳</div>
                <div>
                    <h6 class="text-muted text-uppercase mb-1 fw-bold fs-7">Piutang Belum Lunas</h6>
                    <h3 class="text-dark fw-extrabold mb-0">{{ $data['piutangBelumLunas'] }} Transaksi</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card { transition: transform 0.3s ease; cursor: default; }
    .stat-card:hover { transform: translateY(-5px); }
    .fs-7 { font-size: 0.75rem; letter-spacing: 0.5px; }
    .fw-extrabold { font-weight: 800 !important; }
</style>

@endsection