<!DOCTYPE html>
<html>
<head>
    <title>Laporan Piutang</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        
        /* Judul Laporan */
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; text-transform: uppercase; }

        /* Pengaturan Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 10px; text-align: center; }
        td { padding: 8px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }

        /* Tanda Tangan */
        .signature-section { margin-top: 40px; width: 100%; }
        .signature-box { float: right; width: 220px; text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN PIUTANG</h2>
        <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Total Piutang</th>
                <th>Sisa Piutang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($piutangs as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $item->penjualan?->kode_penjualan }}</td>
                <td>{{ $item->penjualan?->pelanggan?->nama }}</td>
                <td class="text-right">Rp {{ number_format($item->total_piutang, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->sisa_piutang, 0, ',', '.') }}</td>
                <td class="text-center">{{ strtoupper($item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-box">
            <p>Dicetak oleh,</p>
            <br><br><br>
            <p><strong>( {{ auth()->user()->name }} )</strong></p>
        </div>
    </div>

</body>
</html>