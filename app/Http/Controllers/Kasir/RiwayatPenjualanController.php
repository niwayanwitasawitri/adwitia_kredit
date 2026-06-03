<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatPenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with([
            'pelanggan'
        ])
        ->latest()
        ->get();

        return view(
            'kasir.riwayat.index',
            compact('penjualans')
        );
    }

    public function show(
        Penjualan $penjualan
    )
    {
        $penjualan->load([

            'pelanggan',
            'detailPenjualans.produk',
            'pembayarans',
            'piutang'

        ]);

        return view(
            'kasir.riwayat.show',
            compact('penjualan')
        );
    }

   public function cetak()
{
    $penjualans = Penjualan::with([
        'pelanggan'
    ])
    ->latest()
    ->get();

    $pdf = Pdf::loadView(
        'kasir.riwayat.pdf',
        compact('penjualans')
    );

    return $pdf->download(
        'riwayat-penjualan.pdf'
    );
}
}