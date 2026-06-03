<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Tampilkan semua permission
     */
    public function index()
    {
        $permissions = Permission::latest()->get();

        return view(
            'admin.permissions.index',
            compact('permissions')
        );
    }

    /**
     * Form tambah permission
     */
    public function create()
    {
        return view(
            'admin.permissions.create'
        );
    }

    /**
     * Simpan permission baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with(
                'success',
                'Permission berhasil ditambahkan'
            );
    }

    /**
     * Detail permission
     */
    public function show(Permission $permission)
    {
        return view(
            'admin.permissions.show',
            compact('permission')
        );
    }

    /**
     * Form edit permission
     */
    public function edit(Permission $permission)
    {
        return view(
            'admin.permissions.edit',
            compact('permission')
        );
    }

    /**
     * Update permission
     */
    public function update(
        Request $request,
        Permission $permission
    ) {

        $request->validate([
            'name' => 'required'
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with(
                'success',
                'Permission berhasil diperbarui'
            );
    }

    /**
     * Hapus permission
     */
    public function destroy(
        Permission $permission
    ) {

        $permission->roles()->detach();

        $permission->delete();

        return redirect()
            ->route('admin.permissions.index')
            ->with(
                'success',
                'Permission berhasil dihapus'
            );
    }
}