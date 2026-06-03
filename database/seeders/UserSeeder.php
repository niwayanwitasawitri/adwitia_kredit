<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where(
            'name',
            'Admin'
        )->first();

        $ownerRole = Role::where(
            'name',
            'Owner'
        )->first();

        $kasirRole = Role::where(
            'name',
            'Kasir'
        )->first();

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::create([

            'role_id' => $adminRole->id,

            'name' => 'Admin',

            'email' => 'admin@gmail.com',

            'password' => Hash::make(
                'admin123'
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | OWNER
        |--------------------------------------------------------------------------
        */

        User::create([

            'role_id' => $ownerRole->id,

            'name' => 'Owner',

            'email' => 'owner@gmail.com',

            'password' => Hash::make(
                'owner123'
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | KASIR
        |--------------------------------------------------------------------------
        */

        User::create([

            'role_id' => $kasirRole->id,

            'name' => 'Kasir',

            'email' => 'kasir@gmail.com',

            'password' => Hash::make(
                'kasir123'
            ),
        ]);
    }
}