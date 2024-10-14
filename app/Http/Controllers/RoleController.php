<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();
        return  view('role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return  view('role.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        $role = Role::firstOrCreate(['name' => $request->rolename]);
        $permissions = $request->permission;
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
        return $this->index();
    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request)
    {
        $role = Role::findById($request->id);
        $role->update($request->all());

        $permissions = $request->permission;

        $role->syncPermissions($permissions);
        return $this->index();
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return $this->index();
    }
}
