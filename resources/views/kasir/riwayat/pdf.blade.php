<!DOCTYPE html>
<html>

<head>
    <title>Laporan Riwayat Penjualan</title>
    <style>
        /* Pengaturan Kertas Cetak */
        @page {
            margin: 1.2cm 1.2cm;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
        }

        /* Header Nota / Dokumen */
        .header-container {
            width: 100%;
            border-bottom: 2px solid #222222;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .title-document {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #111111;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
        }

        .subtitle-document {
            font-size: 10px;
            text-align: center;
            color: #666666;
            margin: 0;
        }

        /* Meta Data Cetak */
        .meta-table {
            width: 100%;
            margin-bottom: 15px;
            font-size: 10px;
        }
        .meta-table td {
            border: none !important;
            padding: 2px 0 !important;
        }

        /* Desain Tabel Utama */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #cccccc;
            padding: 8px 6px;
        }

        table.data-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            color: #222222;
        }

        /* Aligment Kolom */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        
        .fw-bold { font-weight: bold; }
        .font-mono { font-family: monospace; font-size: 11px; }

        /* Label Status yang Menarik (Mirip Badge) */
        .status-lunas {
            color: #2e7d32;
            font-weight: bold;
        }
        .status-piutang {
            color: #c62828;
            font-weight: bold;
        }

        /* Area Tanda Tangan Kasir (Bawah) */
        .signature-container {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signature-box {
            float: right;
            width: 200px;
            text-align: center;
        }

        .signature-space {
            height: 65px; /* Jarak ruang kosong untuk tanda tangan fisik */
        }

        .signature-line {
            border-bottom: 1px solid #222222;
            font-weight: bold;
            color: #111111;
            padding-bottom: 2px;
        }

        .signature-role {
            font-size: 10px;
            color: #666666;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <div class="header-container">
        <h2 class="title-document">LAPORAN RIWAYAT PENJUALAN KASIR</h2>
        <p class="subtitle-document">Dokumen arsip resmi rekapitulasi data transaksi penjualan barang dan invoice</p>
    </div>

    <table class="meta-table">
        <tr>
            <td width="15%">Tanggal Cetak</td>
            <td width="2%">:</td>
            <td width="43%">{{ date('d-m-Y H:i') }} WIB</td>
            <td width="15%">Dicetak Oleh</td>
            <td width="2%">:</td>
            <td width="23%">{{ auth()->user()->name ?? auth()->user()->nama ?? 'Sistem Kasir' }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="18%" class="text-center">Kode Nota</th>
                <th width="30%">Nama Pelanggan</th>
                <th width="15%" class="text-center">Tanggal</th>
                <th width="15%" class="text-center">Status</th>
                <th width="17%" class="text-right">Total Belanja</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($penjualans as $penjualan)
            @php $grandTotal += $penjualan->total; @endphp
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center font-mono fw-bold">{{ $penjualan->kode_penjualan }}</td>
                <td class="text-left">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</td>
                <td class="text-center">{{ $penjualan->created_at->format('d-m-Y') }}</td>
                <td class="text-center">
                    @if(trim(strtoupper($penjualan->status)) == 'LUNAS')
                        <span class="status-lunas">LUNAS</span>
                    @else
                        <span class="status-piutang">{{ strtoupper($penjualan->status) }}</span>
                    @endif
                </td>
                <td class="text-right font-mono">Rp {{ number_format($penjualan->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            
            <tr style="background-color: #fafafa;">
                <td colspan="5" class="text-right fw-bold" style="padding: 10px 6px;">TOTAL KESELURUHAN OMSET :</td>
                <td class="text-right fw-bold font-mono" style="color: #0056b3; padding: 10px 6px;">
                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="signature-container">
        <div class="signature-box">
            <div>Palembang, {{ date('d F Y') }}</div>
            <div class="signature-role">Petugas Kasir,</div>
            <div class="signature-space"></div>
            <div class="signature-line">{{ auth()->user()->name ?? auth()->user()->nama ?? '_________________' }}</div>
            <div class="signature-role">ID Petugas: #{{ auth()->user()->id ?? '0' }}</div>
        </div>
    </div>

</body>
</html>