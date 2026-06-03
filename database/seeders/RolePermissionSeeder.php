<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where(
            'name',
            'Admin'
        )->first();

        $owner = Role::where(
            'name',
            'Owner'
        )->first();

        $kasir = Role::where(
            'name',
            'Kasir'
        )->first();

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($admin) {

            $admin->permissions()->sync(
                Permission::pluck('id')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | OWNER
        |--------------------------------------------------------------------------
        */

        if ($owner) {

            $ownerPermissions = Permission::whereIn(
                'name',
                [

                    'read.laporan-penjualan',
                    'print.laporan-penjualan',

                    'read.laporan-kredit',
                    'print.laporan-kredit',

                    'read.laporan-piutang',
                    'print.laporan-piutang',

                    'read.laporan-stok',
                    'print.laporan-stok',

                ]
            )->pluck('id');

            $owner->permissions()->sync(
                $ownerPermissions
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KASIR
        |--------------------------------------------------------------------------
        */

        if ($kasir) {

            $kasirPermissions = Permission::whereIn(
                'name',
                [

                    // PRODUK
                    'read.produk',

                    // PELANGGAN
                    'create.pelanggan',
                    'read.pelanggan',
                    'update.pelanggan',

                    // PENJUALAN
                    'create.penjualan',
                    'read.penjualan',
                    'update.penjualan',
                    'delete.penjualan',

                    // RIWAYAT
                    'print.riwayat-penjualan',

                    // PEMBAYARAN
                    'create.pembayaran',
                    'read.pembayaran',

                    // PIUTANG
                    'read.piutang',

                    // CICILAN
                    'create.cicilan',

                ]
            )->pluck('id');

            $kasir->permissions()->sync(
                $kasirPermissions
            );
        }
    }
}