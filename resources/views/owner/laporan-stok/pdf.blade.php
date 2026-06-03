<!DOCTYPE html>

<html>

<head>


    <title>
        Laporan Stok Produk
    </title>

    <style>
    body {
        font-family: sans-serif;
        font-size: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
    }
    </style>


</head>

<body>


    <h2 align="center">

        LAPORAN STOK PRODUK

    </h2>

    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>Kategori</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Stok</th>

            </tr>

        </thead>

        <tbody>

            @foreach($produks as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kategori?->nama_kategori }}</td>

                <td>{{ $item->nama_produk }}</td>

                <td>
                    Rp {{ number_format($item->harga,0,',','.') }}
                </td>

                <td>{{ $item->stok }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>


</body>

</html>