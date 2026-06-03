<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with([
            'pelanggan',
            'user'
        ]);

        if ($request->filled('tanggal_awal')
            && $request->filled('tanggal_akhir')) {

            $query->whereBetween(
                'tanggal',
                [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]
            );
        }

        $penjualans = $query
            ->latest()
            ->get();

        return view(
            'owner.laporan-penjualan.index',
            compact('penjualans')
        );
    }

    public function show(
        Penjualan $penjualan
    ) {

        $penjualan->load([
            'pelanggan',
            'user',
            'detailPenjualans.produk',
            'pembayarans',
            'piutang'
        ]);

        return view(
            'owner.laporan-penjualan.show',
            compact('penjualan')
        );
    }
public function cetak()
{
    $penjualans = Penjualan::with([
        'pelanggan',
        'user'
    ])->get();

    $pdf = Pdf::loadView(
        'owner.laporan-penjualan.pdf',
        compact('penjualans')
    );

    return $pdf->download(
        'laporan-penjualan.pdf'
    );
}

}