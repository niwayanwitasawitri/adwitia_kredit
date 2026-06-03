<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        
        /* Pengaturan Tanda Tangan */
        .signature-section {
            margin-top: 50px;
            width: 100%;
        }
        .signature-box {
            float: right; /* Tanda tangan di kanan bawah */
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2 align="center">LAPORAN PENJUALAN</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_penjualan }}</td>
                <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                <td>{{ $item->pelanggan?->nama }}</td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                <td>{{ strtoupper($item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bagian Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-box">
            <p>Dicetak pada: {{ date('d-m-Y') }}</p>
            <br><br><br>
            <p><strong>{{ auth()->user()->name }}</strong></p>
        </div>
    </div>

</body>
</html>