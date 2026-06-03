<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    /**
     * Tampilkan semua kategori
     */
    public function index()
    {
        $kategoris = KategoriProduk::latest()
            ->get();

        return view(
            'admin.kategori-produk.index',
            compact('kategoris')
        );
    }


    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view(
            'admin.kategori-produk.create'
        );
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100'
        ]);

        KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route('admin.kategori-produk.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan'
            );
    }

    /**
     * Detail kategori
     */
    public function show(KategoriProduk $kategori_produk)
    {
    return view('admin.kategori-produk.show', [
        'kategori' => $kategori_produk
    ]);
    }

    /**
     * Form edit kategori
     */
    public function edit(KategoriProduk $kategori_produk)
    {
    $kategori = $kategori_produk;

    return view('admin.kategori-produk.edit', compact('kategori'));
    }
    

    /**
     * Update kategori
     */
    public function update(
        Request $request,
        KategoriProduk $kategoriProduk
    ) {

        $request->validate([
            'nama_kategori' => 'required|max:100'
        ]);

        $kategoriProduk->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route('admin.kategori-produk.index')
            ->with(
                'success',
                'Kategori berhasil diperbarui'
            );
    }

    /**
     * Hapus kategori
     */
    public function destroy(
        KategoriProduk $kategoriProduk
    ) {

        $kategoriProduk->delete();

        return redirect()
            ->route('admin.kategori-produk.index')
            ->with(
                'success',
                'Kategori berhasil dihapus'
            );
    }}