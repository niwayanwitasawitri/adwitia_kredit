@extends('layouts.owner.app')

@section('title','Detail Penjualan')

@section('content')

<h3 class="mb-3">

    Detail Penjualan

</h3>

<div class="card mb-3">

    <div class="card-body">

        <table class="table">

            <tr>

                <th>Kode Penjualan</th>

                <td>

                    {{ $penjualan->kode_penjualan }}

                </td>

            </tr>

            <tr>

                <th>Tanggal</th>

                <td>

                    {{ $penjualan->tanggal->format('d-m-Y') }}

                </td>

            </tr>

            <tr>

                <th>Pelanggan</th>

                <td>

                    {{ $penjualan->pelanggan->nama }}

                </td>

            </tr>

            <tr>

                <th>Total</th>

                <td>

                    Rp {{ number_format($penjualan->total) }}

                </td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    {{ strtoupper($penjualan->status) }}

                </td>

            </tr>

        </table>

    </div>

</div>

<div class="card">

    <div class="card-header">

        Detail Produk

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>

                </tr>

            </thead>

            <tbody>

                @foreach(
                $penjualan->detailPenjualans
                as $detail
                )

                <tr>

                    <td>

                        {{ $detail->produk->nama_produk }}

                    </td>

                    <td>

                        Rp {{ number_format(
                            $detail->harga
                        ) }}

                    </td>

                    <td>

                        {{ $detail->qty }}

                    </td>

                    <td>

                        Rp {{ number_format(
                            $detail->subtotal
                        ) }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection