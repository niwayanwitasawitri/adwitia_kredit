<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan semua user
     */
    public function index()
    {
        $users = User::with('role')
            ->latest()
            ->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        $roles = Role::all();

        return view(
            'admin.users.create',
            compact('roles')
        );
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $request->validate([

            'role_id' => 'required',

            'name' => 'required|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6'
        ]);

        User::create([

            'role_id' => $request->role_id,

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil ditambahkan'
            );
    }

    /**
     * Detail user
     */
    public function show(User $user)
    {
        $user->load('role');

        return view(
            'admin.users.show',
            compact('user')
        );
    }

    /**
     * Form edit user
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view(
            'admin.users.edit',
            compact(
                'user',
                'roles'
            )
        );
    }

    /**
     * Update user
     */
    public function update(
        Request $request,
        User $user
    ) {

        $request->validate([

            'role_id' => 'required',

            'name' => 'required',

            'email' => 'required|email'
        ]);

        $user->update([

            'role_id' => $request->role_id,

            'name' => $request->name,

            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil diperbarui'
            );
    }

    /**
     * Update password
     */
    public function updatePassword(
        Request $request,
        User $user
    ) {

        $request->validate([
            'password' => 'required|min:6'
        ]);

        $user->update([
            'password' => Hash::make(
                $request->password
            )
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Password berhasil diubah'
            );
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil dihapus'
            );
    }
}