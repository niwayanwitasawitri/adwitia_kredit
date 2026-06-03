<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Pembayaran;
use App\Models\Piutang;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalRoles' => Role::count(),
            'totalPermissions' => Permission::count(),

            'totalProduks' => Produk::count(),
            'totalKategoriProduks' => KategoriProduk::count(),

            'totalPelanggans' => Pelanggan::count(),

            'totalPenjualans' => Penjualan::count(),

            'totalPembayarans' => Pembayaran::count(),

            'totalPiutangs' => Piutang::count(),

            'piutangBelumLunas' => Piutang::where(
                'status',
                'belum_lunas'
            )->count(),

            'piutangLunas' => Piutang::where(
                'status',
                'lunas'
            )->count(),
        ];

        return view(
            'admin.dashboard.index',
            compact('data')
        );
    }
}