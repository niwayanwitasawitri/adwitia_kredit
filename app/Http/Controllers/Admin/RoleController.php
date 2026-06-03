<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Menampilkan semua role
     */
    public function index()
    {
        $roles = Role::with('permissions')
            ->latest()
            ->get();

        return view(
            'admin.roles.index',
            compact('roles')
        );
    }

    /**
     * Form tambah role
     */
    public function create()
{
    $permissions = Permission::all()
        ->groupBy(function ($permission) {

            $parts = explode(
                '.',
                $permission->name
            );

            return $parts[1] ?? 'lainnya';
        });

    return view(
        'admin.roles.create',
        compact('permissions')
    );
}

    /**
     * Simpan role baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        if ($request->has('permissions')) {

            $role->permissions()
                ->sync($request->permissions);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Role berhasil ditambahkan'
            );
    }

    /**
     * Detail role
     */
    public function show(Role $role)
    {
        $role->load('permissions');

        return view(
            'admin.roles.show',
            compact('role')
        );
    }

    /**
     * Form edit role
     */
    public function edit(Role $role)
{
    $permissions = Permission::all()
        ->groupBy(function ($permission) {

            $parts = explode(
                '.',
                $permission->name
            );

            return $parts[1] ?? 'lainnya';
        });

    $role->load('permissions');

    return view(
        'admin.roles.edit',
        compact(
            'role',
            'permissions'
        )
    );
}

    /**
     * Update role
     */
    public function update(
        Request $request,
        Role $role
    ) {

        $request->validate([
            'name' => 'required'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->permissions()->sync(
            $request->permissions ?? []
        );

        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Role berhasil diperbarui'
            );
    }

    /**
     * Hapus role
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();

        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with(
                'success',
                'Role berhasil dihapus'
            );
    }
}