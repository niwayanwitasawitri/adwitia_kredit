<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'confirmed',
                'min:6'
            ]
        ]);

        /*
        Cari Role Kasir
        */

        $role = Role::where(
            'name',
            'Kasir'
        )->first();

        if (!$role) {

            return back()
                ->withErrors([
                    'role' => 'Role Kasir belum tersedia'
                ]);
        }

        /*
        Simpan User
        */

        $user = User::create([

            'role_id' => $role->id,

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),
        ]);

        /*
        Auto Login
        */

        Auth::login($user);

        return redirect()
            ->route('kasir.dashboard')
            ->with(
                'success',
                'Registrasi berhasil'
            );
    }
}