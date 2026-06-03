<!DOCTYPE html>

<html>

<head>


    <title>
        Laporan Kredit
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

        LAPORAN KREDIT

    </h2>

    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Total Kredit</th>
                <th>Sisa Piutang</th>

            </tr>

        </thead>

        <tbody>

            @foreach($penjualans as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_penjualan }}</td>

                <td>{{ $item->pelanggan?->nama }}</td>

                <td>
                    Rp {{ number_format($item->total,0,',','.') }}
                </td>

                <td>
                    Rp {{ number_format($item->piutang?->sisa_piutang ?? 0,0,',','.') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>
    ```

</body>

</html>