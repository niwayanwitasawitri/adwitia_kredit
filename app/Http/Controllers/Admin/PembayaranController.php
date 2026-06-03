<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    /**
     * Menampilkan seluruh pembayaran
     */
    public function index()
    {
        $pembayarans = Pembayaran::with([
            'penjualan',
            'penjualan.pelanggan'
        ])
        ->latest()
        ->get();

        return view(
            'admin.pembayaran.index',
            compact('pembayarans')
        );
    }

    /**
     * Detail pembayaran
     */
    public function show(
        Pembayaran $pembayaran
    ) {

        $pembayaran->load([
            'penjualan',
            'penjualan.pelanggan'
        ]);

        return view(
            'admin.pembayaran.show',
            compact('pembayaran')
        );
    }

    /**
     * Form create tidak digunakan
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store tidak digunakan
     */
    public function store()
    {
        abort(404);
    }

    /**
     * Edit tidak digunakan
     */
    public function edit(
        Pembayaran $pembayaran
    ) {
        abort(404);
    }

    /**
     * Update tidak digunakan
     */
    public function update()
    {
        abort(404);
    }

    /**
     * Hapus pembayaran
     */
    public function destroy(
        Pembayaran $pembayaran
    ) {

        $pembayaran->delete();

        return redirect()
            ->route('admin.pembayaran.index')
            ->with(
                'success',
                'Data pembayaran berhasil dihapus'
            );
    }
}