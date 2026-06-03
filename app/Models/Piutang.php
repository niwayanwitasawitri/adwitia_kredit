<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use carbon\Carbon;

class Piutang extends Model
{
    protected $fillable = [
        'penjualan_id',
        'total_piutang',
        'sisa_piutang',
        'jatuh_tempo',
        'status'
    ];

    protected $casts = [
        'jatuh_tempo' => 'date'
    ];

    public function penjualan()
    {
        return $this->belongsTo(
            Penjualan::class
        );
    }
    public function getKalkulasiBungaAttribute()
    {
        // Ambil nominal dasar dari sisa_piutang Anda saat ini
        $sisaPokok = $this->sisa_piutang;
        
        // Menggunakan tanggal dibuatnya piutang (created_at) sebagai acuan awal hitungan bulan
        $tanggalMulai = Carbon::parse($this->created_at);
        $hariIni = Carbon::now();

        // Hitung selisih hari dari awal piutang dibuat sampai hari ini
        $selisihHari = $tanggalMulai->diffInDays($hariIni);

        // 1. Bunga aktif otomatis bulan pertama (5%)
        $persenBunga = 0.05; 
        $hariTerlambat = 0;

        // 2. Apabila pembayaran lebih dari sebulan (30 hari), bunga naik per hari (5% / 30)
        if ($selisihHari > 30) {
            $hariTerlambat = $selisihHari - 30;
            $bungaHarian = 0.05 / 30; // Rumus: 5% bagi 30 hari
            
            // Akumulasi: Bunga bulan pertama (5%) + (bunga harian x jumlah hari terlambat)
            $persenBunga += ($bungaHarian * $hariTerlambat);
        }

        // 3. Hitung Nominal rupiah denda bunga & Total Akhir yang harus dibayar
        $nominalBunga = $sisaPokok * $persenBunga;
        $totalWajibBayar = $sisaPokok + $nominalBunga;

        // Kirimkan hasilnya dalam bentuk Array agar mudah dipanggil di Blade
        return [
            'sisa_pokok'     => $sisaPokok,
            'persen_bunga'   => $persenBunga * 100, // Konversi ke bentuk persen (misal: 5.83%)
            'nominal_bunga'  => $nominalBunga,
            'total_wajib_bayar' => $totalWajibBayar,
            'hari_terlambat' => $hariTerlambat,
            'status_durasi'  => $selisihHari > 30 ? "Lewat Sebulan (+{$hariTerlambat} Hari)" : "Bulan Berjalan"
        ];
    }
}
