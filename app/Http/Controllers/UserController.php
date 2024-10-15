<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return  view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create-account', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $roleName = $request->roleName;
        $user->assignRole($roleName);
        return $this->index();
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $userRole = $user->roles->toArray();
        // dd($user->roles->toArray());
        return view('user.edit', compact('user', 'roles', 'userRole'));
    }
    public function update(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);
        $user->update($request->all());

        $roleName = $request->roleName;
        $user->syncRoles($roleName);
        return $this->index();
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
