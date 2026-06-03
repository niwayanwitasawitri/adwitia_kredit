<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    /**
     * Proses Login
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);

        // Cari email
        $user = User::where('email', $request->email)->first();

        // Email tidak ditemukan
        if (!$user) {

            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Email tidak ditemukan'
                ]);
        }

        // Password salah
        if (!Hash::check(
            $request->password,
            $user->password
        )) {

            return back()
                ->withInput()
                ->withErrors([
                    'password' => 'Password salah'
                ]);
        }

        // Login berhasil
        Auth::login($user);

        $request->session()->regenerate();

        return $this->redirectByRole();
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Redirect berdasarkan Role
     */
    private function redirectByRole()
    {
        $role = Auth::user()->role->name;

        return match ($role) {

            'Admin' => redirect()
                ->route('admin.dashboard'),

            'Kasir' => redirect()
                ->route('kasir.dashboard'),

            'Owner' => redirect()
                ->route('owner.dashboard'),

            default => abort(403)
        };
    }
}