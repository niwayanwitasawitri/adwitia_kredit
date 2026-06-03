<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [

            'totalProduk' =>
                Produk::count(),

            'totalPelanggan' =>
                Pelanggan::count(),

            'totalPenjualan' =>
                Penjualan::count(),

            'penjualanHariIni' =>
                Penjualan::whereDate(
                    'tanggal',
                    today()
                )->count(),
        ];

        return view(
            'kasir.dashboard.index',
            compact('data')
        );
    }
}