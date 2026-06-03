<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // USER
            'create.user',
            'read.user',
            'update.user',
            'delete.user',

            // ROLE
            'create.role',
            'read.role',
            'update.role',
            'delete.role',

            // PERMISSION
            'create.permission',
            'read.permission',
            'update.permission',
            'delete.permission',

            // KATEGORI PRODUK
            'create.kategori-produk',
            'read.kategori-produk',
            'update.kategori-produk',
            'delete.kategori-produk',

            // PRODUK
            'create.produk',
            'read.produk',
            'update.produk',
            'delete.produk',

            // PELANGGAN
            'create.pelanggan',
            'read.pelanggan',
            'update.pelanggan',
            'delete.pelanggan',

            // PENJUALAN
            'create.penjualan',
            'read.penjualan',
            'update.penjualan',
            'delete.penjualan',

            // PEMBAYARAN
            'create.pembayaran',
            'read.pembayaran',
            'update.pembayaran',
            'delete.pembayaran',

            // PIUTANG
            'read.piutang',

            // CICILAN
            'create.cicilan',

            // CETAK RIWAYAT KASIR
            'print.riwayat-penjualan',

            // OWNER LAPORAN
            'read.laporan-penjualan',
            'print.laporan-penjualan',

            'read.laporan-kredit',
            'print.laporan-kredit',

            'read.laporan-piutang',
            'print.laporan-piutang',

            'read.laporan-stok',
            'print.laporan-stok',
        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
    }
}