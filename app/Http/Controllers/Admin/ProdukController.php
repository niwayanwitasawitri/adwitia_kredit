<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Tampilkan semua produk
     */
    public function index()
    {
        $produks = Produk::with('kategori')
            ->latest()
            ->get();

        return view(
            'admin.produk.index',
            compact('produks')
        );
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $kategoris = KategoriProduk::all();

        return view(
            'admin.produk.create',
            compact('kategoris')
        );
    }

    /**
     * Simpan produk
     */
    public function store(Request $request)
    {
        $request->validate([

            'kategori_produk_id' => 'required',

            'nama_produk' => 'required|max:255',

            'harga' => 'required|numeric',

            'stok' => 'required|integer|min:0',
        ]);

        Produk::create([

            'kategori_produk_id' =>
                $request->kategori_produk_id,

            'nama_produk' =>
                $request->nama_produk,

            'harga' =>
                $request->harga,

            'stok' =>
                $request->stok,

            'deskripsi' =>
                $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.produk.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );
    }

    /**
     * Detail produk
     */
    public function show(Produk $produk)
    {
        $produk->load('kategori');

        return view(
            'admin.produk.show',
            compact('produk')
        );
    }

    /**
     * Form edit produk
     */
    public function edit(Produk $produk)
    {
        $kategoris = KategoriProduk::all();

        return view(
            'admin.produk.edit',
            compact(
                'produk',
                'kategoris'
            )
        );
    }

    /**
     * Update produk
     */
    public function update(
        Request $request,
        Produk $produk
    ) {

        $request->validate([

            'kategori_produk_id' => 'required',

            'nama_produk' => 'required',

            'harga' => 'required|numeric',

            'stok' => 'required|integer'
        ]);

        $produk->update([

            'kategori_produk_id' =>
                $request->kategori_produk_id,

            'nama_produk' =>
                $request->nama_produk,

            'harga' =>
                $request->harga,

            'stok' =>
                $request->stok,

            'deskripsi' =>
                $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.produk.index')
            ->with(
                'success',
                'Produk berhasil diperbarui'
            );
    }

    /**
     * Hapus produk
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with(
                'success',
                'Produk berhasil dihapus'
            );
    }
}