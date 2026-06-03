<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'kode_penjualan',
        'tanggal',
        'total',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function piutang()
    {
        return $this->hasOne(Piutang::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getTotalDibayarAttribute()
    {
        return $this->pembayarans->sum('jumlah_bayar');
    }

    public function getSisaPiutangAttribute()
    {
        return $this->piutang?->sisa_piutang ?? 0;
    }

    // ... Tetapkan semua kode fillable, casts, dan relationship bawaan Anda ...

    /*
   /*
    |/*
    |--------------------------------------------------------------------------
    | FIX PERBAIKAN: MENGGUNAKAN METHOD BIASA UNTUK MENGHINDARI LOOPING ERROR
    |--------------------------------------------------------------------------
    */

    // 1. Ganti dari getTotalDibayarAttribute() menjadi fungsi biasa
    public function totalDibayar()
    {
        return \DB::table('pembayarans')
            ->where('penjualan_id', $this->id)
            ->sum('jumlah_bayar') ?? 0;
    }

    // 2. Ganti dari getSisaPiutangAttribute() menjadi fungsi biasa
    public function sisaPiutangPokok()
    {
        return \DB::table('piutangs')
            ->where('penjualan_id', $this->id)
            ->value('sisa_piutang') ?? 0;
    }

    // 3. Fungsi untuk mengambil info bunga otomatis (menggunakan Query Builder agar super aman)
    public function infoBungaOtomatis()
    {
        // Jika lunas atau data piutang tidak ada, tampilkan nilai asli penjualan
        if ($this->status == 'lunas' || !$this->piutang) {
            return [
                'sisa_pokok'        => 0,
                'persen_bunga'      => 0,
                'nominal_bunga'     => 0,
                'sisa_tagihan_piutang' => 0,
                'total_transaksi_akhir' => $this->total,
                'hari_terlambat'    => 0,
                'status_durasi'     => 'Lunas'
            ];
        }

        // 1. Ambil sisa piutang riil di database saat ini (setelah dipotong DP atau cicilan)
        $sisaPokok = $this->piutang->sisa_piutang;
        
        // 2. Hitung durasi keterlambatan berdasarkan tanggal piutang dibuat
        $tanggalMulai = \Carbon\Carbon::parse($this->piutang->created_at);
        $hariIni = \Carbon\Carbon::now();
        $selisihHari = $tanggalMulai->diffInDays($hariIni);

        $persenBunga = 0.05; // Bunga dasar 5% otomatis aktif per bulan
        $hariTerlambat = 0;

        // 3. Logika kenaikan bunga per hari setelah 30 hari
        if ($selisihHari > 30) {
            $hariTerlambat = $selisihHari - 30;
            $bungaHarian = 0.05 / 30;
            $persenBunga += ($bungaHarian * $hariTerlambat);
        }

        // 4. Kalkulasi Nominal Rupiah Bunga
        $nominalBunga = $sisaPokok * $persenBunga;

        // 5. Rumus Detail Gabungan agar Angka Penjualan Tidak Terlihat Berkurang
        $sisaTagihanPiutang = $sisaPokok + $nominalBunga; 
        $totalTransaksiAkhir = ($this->total - $sisaPokok) + $sisaTagihanPiutang;

        return [
            'sisa_pokok'        => $sisaPokok,
            'persen_bunga'      => $persenBunga * 100,
            'nominal_bunga'     => $nominalBunga,
            'sisa_tagihan_piutang' => $sisaTagihanPiutang, // Sisa utang + bunga (Untuk dicicil)
            'total_transaksi_akhir' => $totalTransaksiAkhir, // Nilai Nota Asli + bunga (Agar total gak berkurang)
            'hari_terlambat'    => $hariTerlambat,
            'status_durasi'     => $selisihHari > 30 ? "Lewat Sebulan (+{$hariTerlambat} Hari)" : "Bulan Berjalan"
        ];
    }
}