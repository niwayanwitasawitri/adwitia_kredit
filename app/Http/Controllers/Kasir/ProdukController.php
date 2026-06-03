<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with(
            'kategori'
        )->latest()->get();

        return view(
            'kasir.produk.index',
            compact('produks')
        );
    }

    public function show(
        Produk $produk
    )
    {
        return view(
            'kasir.produk.show',
            compact('produk')
        );
    }
}