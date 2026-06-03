<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Piutang;
use App\Models\Produk;
use App\Models\Pelanggan;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [

            'totalPenjualan' =>
                Penjualan::count(),

            'totalPelanggan' =>
                Pelanggan::count(),

            'totalProduk' =>
                Produk::count(),

            'totalPiutang' =>
                Piutang::sum(
                    'sisa_piutang'
                ),

            'piutangBelumLunas' =>
                Piutang::where(
                    'status',
                    'belum_lunas'
                )->count(),

            'piutangLunas' =>
                Piutang::where(
                    'status',
                    'lunas'
                )->count(),
        ];

        return view(
            'owner.dashboard.index',
            compact('data')
        );
    }
}