<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pembayaran;
use App\Models\Piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
/*
    |--------------------------------------------------------------------------
    | List Transaksi
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // PERBAIKAN: Menambahkan 'piutang' agar data piutang terbaca di halaman utama tabel
        $penjualans = Penjualan::with([
            'pelanggan',
            'user',
            'piutang' 
        ])
        ->latest()
        ->paginate(10);

        return view(
            'kasir.penjualan.index',
            compact('penjualans')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Form Transaksi
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $produks = Produk::orderBy(
            'nama_produk'
        )->get();

        $pelanggans = Pelanggan::orderBy(
            'nama'
        )->get();

        return view(
            'kasir.penjualan.create',
            compact(
                'produks',
                'pelanggans'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Transaksi
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'pelanggan_id' =>
                'required|exists:pelanggans,id',

            'produk_id' =>
                'required|array|min:1',

            'produk_id.*' =>
                'required|exists:produks,id',

            'qty' =>
                'required|array|min:1',

            'qty.*' =>
                'required|integer|min:1',

            'dp' =>
                'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            $total = 0;

            foreach ($request->produk_id as $key => $produkId) {

                $produk = Produk::findOrFail(
                    $produkId
                );

                $qty = $request->qty[$key];

                if ($qty > $produk->stok) {

                    throw new \Exception(
                        'Stok produk ' .
                        $produk->nama_produk .
                        ' tidak mencukupi'
                    );
                }

                $subtotal =
                    $produk->harga * $qty;

                $total += $subtotal;
            }

            $dp = $request->dp ?? 0;

            if ($dp > $total) {

                throw new \Exception(
                    'DP tidak boleh melebihi total transaksi'
                );
            }

            $sisaPiutang =
                $total - $dp;

            $status =
                $sisaPiutang <= 0
                ? 'lunas'
                : 'belum_lunas';

            /*
            |--------------------------------------------------------------------------
            | Penjualan
            |--------------------------------------------------------------------------
            */

            $penjualan = Penjualan::create([

                'user_id' =>
                    auth()->id(),

                'pelanggan_id' =>
                    $request->pelanggan_id,

                'kode_penjualan' =>
                    'PJ-' .
                    now()->format('YmdHis'),

                'tanggal' =>
                    now(),

                'total' =>
                    $total,

                'status' =>
                    $status,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Detail Penjualan
            |--------------------------------------------------------------------------
            */

            foreach ($request->produk_id as $key => $produkId) {

                $produk = Produk::findOrFail(
                    $produkId
                );

                $qty = $request->qty[$key];

                $subtotal =
                    $produk->harga * $qty;

                DetailPenjualan::create([

                    'penjualan_id' =>
                        $penjualan->id,

                    'produk_id' =>
                        $produk->id,

                    'qty' =>
                        $qty,

                    'harga' =>
                        $produk->harga,

                    'subtotal' =>
                        $subtotal,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Kurangi Stok
                |--------------------------------------------------------------------------
                */

                $produk->decrement(
                    'stok',
                    $qty
                );
            }

            /*
            |--------------------------------------------------------------------------
            | DP Awal
            |--------------------------------------------------------------------------
            */

            if ($dp > 0) {

                Pembayaran::create([

                    'penjualan_id' =>
                        $penjualan->id,

                    'tanggal_bayar' =>
                        now(),

                    'jumlah_bayar' =>
                        $dp,

                    'keterangan' =>
                        'DP Awal',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Piutang
            |--------------------------------------------------------------------------
            */

            if ($sisaPiutang > 0) {

                Piutang::create([

                    'penjualan_id' =>
                        $penjualan->id,

                    'total_piutang' =>
                        $total,

                    'sisa_piutang' =>
                        $sisaPiutang,

                    'jatuh_tempo' =>
                        now()->addDays(30),

                    'status' =>
                        'belum_lunas',
                ]);
            }

            DB::commit();

            return redirect()
                ->route(
                    'kasir.penjualan.index'
                )
                ->with(
                    'success',
                    'Transaksi berhasil dibuat'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Detail Transaksi
    |--------------------------------------------------------------------------
    */

    public function show(
        Penjualan $penjualan
    )
    {
        $penjualan->load([

            'user',
            'pelanggan',
            'detailPenjualans.produk',
            'pembayarans',
            'piutang'
        ]);

        return view(
            'kasir.penjualan.show',
            compact('penjualan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Transaksi
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Penjualan $penjualan
    )
    {
        DB::beginTransaction();

        try {

            foreach (
                $penjualan->detailPenjualans
                as $detail
            ) {

                $detail->produk
                    ->increment(
                        'stok',
                        $detail->qty
                    );
            }

            $penjualan
                ->detailPenjualans()
                ->delete();

            $penjualan
                ->pembayarans()
                ->delete();

            if ($penjualan->piutang) {

                $penjualan
                    ->piutang()
                    ->delete();
            }

            $penjualan->delete();

            DB::commit();

            return redirect()
                ->route(
                    'kasir.penjualan.index'
                )
                ->with(
                    'success',
                    'Transaksi berhasil dihapus'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }
}