<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Piutang;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPiutangController extends Controller
{
    public function index()
    {
        $piutangs = Piutang::with([
            'penjualan',
            'penjualan.pelanggan'
        ])
        ->latest()
        ->get();

        return view(
            'owner.laporan-piutang.index',
            compact('piutangs')
        );
    }

    public function show(
        Piutang $piutang
    ) {

        $piutang->load([
            'penjualan',
            'penjualan.pelanggan'
        ]);

        return view(
            'owner.laporan-piutang.show',
            compact('piutang')
        );
    }

   public function cetak()
{
    $piutangs = Piutang::with([
        'penjualan',
        'penjualan.pelanggan'
    ])->get();

    $pdf = Pdf::loadView(
        'owner.laporan-piutang.pdf',
        compact('piutangs')
    );

    return $pdf->download(
        'laporan-piutang.pdf'
    );
}

}