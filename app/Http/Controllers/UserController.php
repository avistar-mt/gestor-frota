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
        $title = 'Gerenciamento de Usuário';

        $this->authorize('manage-users', User::class);

        return view('laravel.users.index', ['users' => $model->all(), 'title' => $title]);
    }

    public function create()
    {
        $this->authorize('manage-users', User::class);
        $title = 'Criar Usuário';
        $roles = Role::all();
        $branches = Branch::all();
        return view('laravel.users.create', compact('roles', 'branches', 'title'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        
        $data = request()->validate([
            'firstname' => ['required'],
            'lastname' => ['nullable'],
            'email' => ['required', 'unique:users', 'email'],
            'cpf' => ['required', 'unique:users', function ($attribute, $value, $fail) {
                $cpf = preg_replace('/[^0-9]/', '', $value);
                $cpfExists = User::where('cpf', $cpf)->exists();
                if ($cpfExists) {
                    $fail('CPF já cadastrado.');
                }
            }],
            'confirmation' => ['same:email'],
            'password' => ['required', 'min:8'],
            'confirm-password' => ['same:password'],
            'role_id' => ['nullable','required', 'exists:roles,id'],
            'cnh_number' => ['nullable', 'required_if:role_id,5'], 
            'cnh_due_date' => ['nullable', 'required_if:role_id,5', 'after:today'],
            'cnh_category' => ['nullable', 'required_if:role_id,5'],
            'branch_id' => ['required'],
            'phone' => ['max:20'], 
            'birthday' => ['required','date_format:d/m/Y', 'before:today'], 
            'location' => ['required']
        ]);

        $user = User::create($data);

        $user->cpf = preg_replace('/[^0-9]/', '', $request->get('cpf'));


        if($request->get('role_id') == 5) {
            $user->cnh_number = $request->get('cnh_number');
            $user->cnh_due_date = Carbon::createFromFormat('d/m/Y', $request->get('cnh_due_date'))->format('Y-m-d');
            $user->cnh_category = $request->get('cnh_category');
        }

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
            'role_id' => ['required'],
            'phone' => ['max:20'], 
            'birthday' => ['required','date', 'before:today']
        ]);


        $cpf  = preg_replace('/[^0-9]/', '', $request->get('cpf'));

        $user ->update($attributes);

        $user->cpf = $cpf;

        if($request->get('role_id') == 5) {
            $user->cnh_number = $request->get('cnh_number');
            $user->cnh_due_date = Carbon::createFromFormat('d/m/Y', $request->get('cnh_due_date'))->format('Y-m-d');
            $user->cnh_category = $request->get('cnh_category');
        }

        return redirect()->route('user-management')->with('succes', 'User succesfully updated');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user->reservations->isEmpty()) {
            return redirect()->route('user-management')->with('error', 'Usuário não pode ser excluído. Favor entrar em contato com Administrador');
        }
        $user->delete();
        return redirect()->route('user-management')->with('succes', 'The user was succesfully deleted');
    }
}
