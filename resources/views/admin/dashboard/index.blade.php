@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@section('content')

<style>
    .dashboard-header{
        background: linear-gradient(135deg,#4CAF50,#81C784);
        border-radius: 20px;
        padding: 25px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(76,175,80,0.2);
    }

    .dashboard-header h2{
        font-weight: 700;
        margin-bottom: 5px;
    }

    .dashboard-header p{
        margin: 0;
        opacity: .9;
    }

    .stat-card{
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        transition: all .3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        height: 100%;
    }

    .stat-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(76,175,80,0.2);
    }

    .card-body-custom{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 22px;
    }

    .icon-box{
        width: 65px;
        height: 65px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
    }

    .bg-green{
        background: linear-gradient(135deg,#4CAF50,#66BB6A);
    }

    .bg-light-green{
        background: linear-gradient(135deg,#81C784,#A5D6A7);
    }

    .bg-dark-green{
        background: linear-gradient(135deg,#388E3C,#4CAF50);
    }

    .card-title-custom{
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .card-number{
        font-size: 30px;
        font-weight: 700;
        color: #2E7D32;
        margin: 0;
    }

    .section-title{
        font-size: 18px;
        font-weight: 700;
        color: #2E7D32;
        margin-bottom: 15px;
    }

    @media(max-width:768px){

        .dashboard-header{
            text-align:center;
            padding:20px;
        }

        .card-body-custom{
            padding:18px;
        }

        .card-number{
            font-size:24px;
        }

        .icon-box{
            width:55px;
            height:55px;
            font-size:24px;
        }
    }
</style>

{{-- HEADER --}}
<div class="dashboard-header">
    <h2>
        🌱 Dashboard Admin
    </h2>
    <p>
        Sistem Kredit Penjualan Obat Pertanian
    </p>
</div>

{{-- MASTER DATA --}}
<div class="section-title">
    Data Master
</div>

<div class="row g-4 mb-4">

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Total User</div>
                    <h3 class="card-number">{{ $data['totalUsers'] }}</h3>
                </div>
                <div class="icon-box bg-green">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Total Role</div>
                    <h3 class="card-number">{{ $data['totalRoles'] }}</h3>
                </div>
                <div class="icon-box bg-light-green">
                    <i class="fas fa-user-tag"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Total Permission</div>
                    <h3 class="card-number">{{ $data['totalPermissions'] }}</h3>
                </div>
                <div class="icon-box bg-dark-green">
                    <i class="fas fa-key"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- PRODUK --}}
<div class="section-title">
    Data Produk
</div>

<div class="row g-4 mb-4">

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Total Produk</div>
                    <h3 class="card-number">{{ $data['totalProduks'] }}</h3>
                </div>
                <div class="icon-box bg-green">
                    <i class="fas fa-seedling"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Total Kategori</div>
                    <h3 class="card-number">{{ $data['totalKategoriProduks'] }}</h3>
                </div>
                <div class="icon-box bg-light-green">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Total Pelanggan</div>
                    <h3 class="card-number">{{ $data['totalPelanggans'] }}</h3>
                </div>
                <div class="icon-box bg-dark-green">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- TRANSAKSI --}}
<div class="section-title">
    Data Transaksi
</div>

<div class="row g-4">

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Total Penjualan</div>
                    <h3 class="card-number">{{ $data['totalPenjualans'] }}</h3>
                </div>
                <div class="icon-box bg-green">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Piutang Lunas</div>
                    <h3 class="card-number">{{ $data['piutangLunas'] }}</h3>
                </div>
                <div class="icon-box bg-light-green">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="stat-card">
            <div class="card-body-custom">
                <div>
                    <div class="card-title-custom">Piutang Belum Lunas</div>
                    <h3 class="card-number">{{ $data['piutangBelumLunas'] }}</h3>
                </div>
                <div class="icon-box bg-dark-green">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection