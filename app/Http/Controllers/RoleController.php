<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Policies\RolePolicy;
use App\Models\User;

class RoleController extends Controller
{
    public function index(Role $model)
    {
        $this->authorize('manage-users', User::class);
        return view('laravel.role.index', ['roles' => $model->all()]);
    }

    public function create(Role $model)
    {
        return view('laravel.role.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::create([
            'name' => $attributes['name'],
        ]);

        return redirect()->route('role-management')->with('succes', 'Role succesfully added');
    }


    public function edit($id)
    {
        $role = Role::find($id);
        return view('laravel.role.edit', compact('role'));
    }

    public function update($id)
    {
        $this->authorize('manage-users', User::class);
        $role = Role::find($id);

        $attributes = request()->validate([
            'name' => ['required',  Rule::unique('roles')->ignore($role->id)],
        ]);

        $role->update($attributes);

        return redirect()->route('role-management')->with('succes', 'Role succesfully updated');
    }

    public function destroy($id)
    {
        $this->authorize('manage-users', User::class);
        $role = Role::find($id);
        // check if it the role attached to an user
        if (!$role->users->isEmpty()) {
            return redirect()->route('role-management')->with('error', 'This role has users attached and can\'t be deleted.');
        }
        $role->delete();
        return redirect()->route('role-management')->with('succes', 'The role was succesfully deleted');
    }
}
