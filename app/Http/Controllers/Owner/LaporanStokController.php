<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanStokController extends Controller
{
    public function index()
    {
        $produks = Produk::with(
            'kategori'
        )
        ->orderBy(
            'stok',
            'asc'
        )
        ->get();

        return view(
            'owner.laporan-stok.index',
            compact('produks')
        );
    }

    public function show(
    Produk $produk
)
{
    $produk->load(
        'kategori'
    );

    return view(
        'owner.laporan-stok.show',
        compact('produk')
    );
}

public function cetak()
{
    $produks = Produk::with(
        'kategori'
    )->get();

    $pdf = Pdf::loadView(
        'owner.laporan-stok.pdf',
        compact('produks')
    );

    return $pdf->download(
        'laporan-stok.pdf'
    );
}

}