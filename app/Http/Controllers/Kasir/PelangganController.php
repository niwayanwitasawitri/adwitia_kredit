<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();

        return view(
            'kasir.pelanggan.index',
            compact('pelanggans')
        );
    }

    public function create()
    {
        return view(
            'kasir.pelanggan.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        Pelanggan::create($request->all());

        return redirect()
            ->route('kasir.pelanggan.index')
            ->with(
                'success',
                'Pelanggan berhasil ditambahkan'
            );
    }

    public function show(
        Pelanggan $pelanggan
    )
    {
        return view(
            'kasir.pelanggan.show',
            compact('pelanggan')
        );
    }

    public function edit(
        Pelanggan $pelanggan
    )
    {
        return view(
            'kasir.pelanggan.edit',
            compact('pelanggan')
        );
    }

    public function update(
        Request $request,
        Pelanggan $pelanggan
    )
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $pelanggan->update(
            $request->all()
        );

        return redirect()
            ->route('kasir.pelanggan.index')
            ->with(
                'success',
                'Pelanggan berhasil diupdate'
            );
    }
}