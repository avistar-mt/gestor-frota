<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;

class UserController extends Controller
{
    public function index(User $model)
    {
        $this->authorize('manage-users', User::class);
        return view('laravel.users.index', ['users' => $model->all()]);
    }

    public function create()
    {
        $roles = Role::all();
        $branches = Branch::all();
        return view('laravel.users.create', compact('roles', 'branches'));
    }

    public function store(Request $request)
    {
        
        $attributes = request()->validate([
            'firstname' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
            'cpf' => ['required', 'unique:users', function ($attribute, $value, $fail) {
                $cpf = preg_replace('/[^0-9]/', '', $value);
                $cpfExists = User::where('cpf', $cpf)->exists();
                if ($cpfExists) {
                    $fail('The CPF has already been taken.');
                }
            }],
            'confirmation' => ['same:email'],
            'password' => ['required', 'min:5'],
            'confirm-password' => ['same:password'],
            'role' => ['required'],
            'branch' => ['required'],
            'phone' => ['max:20'], 
            'birthday' => ['required','date', 'before:today']
        ]);

        $birthday = Carbon::parse($request->get('birthday'))->format('Y-m-d');
        $cpf = preg_replace('/[^0-9]/', '', $request->get('cpf')); 

        $user = User::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'password' => $request->get('password'),
            'role_id' => $request->get('role'),
            'email' => $request->get('email'),
            'cpf' => $cpf,
            'branch_id' => $request->get('branch'),
            'location' => $request->get('location'),
            'phone' => $request->get('phone'),
            'birthday' => $birthday,
        ]);

        $user->cpf = $cpf;
        $user->save();

        return redirect()->route('user-management')->with('succes', 'User succesfully saved');
    }

    public function edit($id)
    {
        $this->authorize('manage-users', User::class);
        $user = User::find($id);
        $roles = Role::all();
        $branches = Branch::all();

        return view ('laravel.users.edit', compact('user', 'roles', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $attributes = request()->validate([
            'firstname' => ['required'],
            'cpf' => ['required', Rule::unique('users', 'cpf')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'confirmation' => ['same:email'],
            'password' => [],
            'confirm-password' => ['same:password'],
            'role' => ['required'],
            'phone' => ['max:20'], 
            'birthday' => ['required','date', 'before:today']
        ]);


        $birthday = Carbon::parse($request->get('birthday'))->format('Y-m-d');
        $cpf  = preg_replace('/[^0-9]/', '', $request->get('cpf'));

        $user ->update([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'cpf' => $cpf,
            'password' => $request->get('password'),
            'role_id' => $request->get('role'),
            'email' => $request->get('email'),
            'location' => $request->get('location'),
            'phone' => $request->get('phone'),
            'birthday' => $birthday,
        ]);

        return redirect()->route('user-management')->with('succes', 'User succesfully updated');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user-management')->with('succes', 'The user was succesfully deleted');
    }
}
