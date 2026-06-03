@extends('layouts.owner.app')

@section('title','Detail Stok Produk')

@section('content')

<h3>

    Detail Produk

</h3>

<div class="card">

    <div class="card-body">

        <table class="table">

            <tr>

                <th>Kategori</th>

                <td>

                    {{ $produk->kategori->nama_kategori }}

                </td>

            </tr>

            <tr>

                <th>Nama Produk</th>

                <td>

                    {{ $produk->nama_produk }}

                </td>

            </tr>

            <tr>

                <th>Harga</th>

                <td>

                    Rp {{ number_format(
                        $produk->harga
                    ) }}

                </td>

            </tr>

            <tr>

                <th>Stok</th>

                <td>

                    {{ $produk->stok }}

                </td>

            </tr>

            <tr>

                <th>Deskripsi</th>

                <td>

                    {{ $produk->deskripsi }}

                </td>

            </tr>

        </table>

    </div>

</div>

@endsection