<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;


class PelangganController extends Controller
{
    /**
     * Tampilkan semua pelanggan
     */
    public function index()
    {
        $pelanggans = Pelanggan::latest()
            ->get();

        return view(
            'admin.pelanggan.index',
            compact('pelanggans')
        );
    }

    /**
     * Form tambah pelanggan
     */
    public function create()
    {
        return view(
            'admin.pelanggan.create'
        );
    }

    /**
     * Simpan pelanggan
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required|max:255',

            'telepon' => 'required|max:20',

            'alamat' => 'required'
        ]);

        Pelanggan::create([

            'nama' => $request->nama,

            'telepon' => $request->telepon,

            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with(
                'success',
                'Pelanggan berhasil ditambahkan'
            );
    }

    /**
     * Detail pelanggan
     */
    public function show(Pelanggan $pelanggan)
    {
        return view(
            'admin.pelanggan.show',
            compact('pelanggan')
        );
    }

    /**
     * Form edit pelanggan
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view(
            'admin.pelanggan.edit',
            compact('pelanggan')
        );
    }

    /**
     * Update pelanggan
     */
    public function update(
        Request $request,
        Pelanggan $pelanggan
    ) {

        $request->validate([

            'nama' => 'required|max:255',

            'telepon' => 'required|max:20',

            'alamat' => 'required'
        ]);

        $pelanggan->update([

            'nama' => $request->nama,

            'telepon' => $request->telepon,

            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with(
                'success',
                'Pelanggan berhasil diperbarui'
            );
    }

    /**
     * Hapus pelanggan
     */
    public function destroy(
        Pelanggan $pelanggan
    ) {

        $pelanggan->delete();

        return redirect()
            ->route('admin.pelanggan.index')
            ->with(
                'success',
                'Pelanggan berhasil dihapus'
            );
    }
}