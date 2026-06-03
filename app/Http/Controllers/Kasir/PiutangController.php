<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Piutang;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PiutangController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Piutang
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $piutangs = Piutang::with([
            'penjualan.pelanggan'
        ])
        ->where(
            'status',
            'belum_lunas'
        )
        ->latest()
        ->get();

        return view(
            'kasir.piutang.index',
            compact('piutangs')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Detail Piutang
    |--------------------------------------------------------------------------
    */

    public function show(
        Piutang $piutang
    )
    {
        $piutang->load([

            'penjualan',
            'penjualan.pelanggan',
            'penjualan.pembayarans'

        ]);

        return view(
            'kasir.piutang.show',
            compact('piutang')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Bayar Cicilan
    |--------------------------------------------------------------------------
    */

    public function bayar(
        Request $request,
        Piutang $piutang
    )
    {
        $request->validate([

            'jumlah_bayar' =>
                'required|numeric|min:1'

        ]);

        if (
            $request->jumlah_bayar >
            $piutang->sisa_piutang
        ) {

            return back()->with(
                'error',
                'Jumlah bayar melebihi sisa piutang'
            );
        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Simpan Pembayaran
            |--------------------------------------------------------------------------
            */

            Pembayaran::create([

                'penjualan_id' =>
                    $piutang->penjualan_id,

                'tanggal_bayar' =>
                    now(),

                'jumlah_bayar' =>
                    $request->jumlah_bayar,

                'keterangan' =>
                    'Cicilan Piutang'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Hitung Sisa Piutang
            |--------------------------------------------------------------------------
            */

            $sisaPiutang =
                $piutang->sisa_piutang
                -
                $request->jumlah_bayar;

            /*
            |--------------------------------------------------------------------------
            | Update Piutang
            |--------------------------------------------------------------------------
            */

            $piutang->update([

                'sisa_piutang' =>
                    $sisaPiutang,

                'status' =>
                    $sisaPiutang <= 0
                    ? 'lunas'
                    : 'belum_lunas'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Status Penjualan
            |--------------------------------------------------------------------------
            */

            if ($sisaPiutang <= 0) {

                $piutang->penjualan->update([

                    'status' =>
                        'lunas'
                ]);
            }

            DB::commit();

            return redirect()
                ->route(
                    'kasir.piutang.show',
                    $piutang
                )
                ->with(
                    'success',
                    'Pembayaran berhasil disimpan'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}