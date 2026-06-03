<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanKreditController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with([
            'pelanggan',
            'piutang'
        ])
        ->where(
            'status',
            'belum_lunas'
        )
        ->latest()
        ->get();

        return view(
            'owner.laporan-kredit.index',
            compact('penjualans')
        );
    }

    public function show(
    Penjualan $penjualan
)
{
    $penjualan->load([

        'pelanggan',
        'piutang',
        'pembayarans'

    ]);

    return view(
        'owner.laporan-kredit.show',
        compact('penjualan')
    );
}

public function cetak()
{
    $penjualans = Penjualan::with([
        'pelanggan',
        'piutang'
    ])
    ->where(
        'status',
        'belum_lunas'
    )
    ->get();

    $pdf = Pdf::loadView(
        'owner.laporan-kredit.pdf',
        compact('penjualans')
    );

    return $pdf->download(
        'laporan-kredit.pdf'
    );
}



}