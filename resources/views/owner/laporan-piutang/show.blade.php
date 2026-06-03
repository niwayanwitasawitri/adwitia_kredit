@extends('layouts.owner.app')

@section('title','Detail Piutang')

@section('content')

<h3 class="mb-3">

    Detail Piutang

</h3>

<div class="card">

    <div class="card-body">

        <table class="table">

            <tr>

                <th>Kode Penjualan</th>

                <td>

                    {{ $piutang->penjualan->kode_penjualan }}

                </td>

            </tr>

            <tr>

                <th>Pelanggan</th>

                <td>

                    {{ $piutang->penjualan->pelanggan->nama }}

                </td>

            </tr>

            <tr>

                <th>Total Piutang</th>

                <td>

                    Rp {{ number_format(
                        $piutang->total_piutang
                    ) }}

                </td>

            </tr>

            <tr>

                <th>Sisa Piutang</th>

                <td>

                    Rp {{ number_format(
                        $piutang->sisa_piutang
                    ) }}

                </td>

            </tr>

            <tr>

                <th>Jatuh Tempo</th>

                <td>

                    {{ $piutang->jatuh_tempo
                        ->format('d-m-Y') }}

                </td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    {{ strtoupper(
                        $piutang->status
                    ) }}

                </td>

            </tr>

        </table>

    </div>

</div>

@if(
$piutang->penjualan
->pembayarans
->count()
)

<div class="card mt-3">

    <div class="card-header">

        Riwayat Pembayaran

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>

                </tr>

            </thead>

            <tbody>

                @foreach(
                $piutang->penjualan
                ->pembayarans
                as $bayar
                )

                <tr>

                    <td>

                        {{ $bayar->tanggal_bayar
                                ->format('d-m-Y') }}

                    </td>

                    <td>

                        Rp {{ number_format(
                            $bayar->jumlah_bayar
                        ) }}

                    </td>

                    <td>

                        {{ $bayar->keterangan }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endif

@endsection