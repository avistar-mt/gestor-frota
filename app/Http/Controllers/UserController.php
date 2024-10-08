<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\ModelVehicle;


class UserController extends Controller
{
    public function index(User $model)
    {
        $title = 'Gerenciamento de Usuário';


        $this->authorize('manage-user');

        return view('laravel.users.index', ['users' => $model->all(), 'title' => $title]);
    }

    public function create()
    {
        // $this->authorize('manage-users', User::class);
        $title = 'Criar Usuário';
        $roles = Role::all();
        $branches = Branch::with('headquarter')->get();
        $modelVehicle = ModelVehicle::all();
        return view('laravel.users.create', compact('roles', 'branches', 'modelVehicle',  'title'));
    }


    public function store(Request $request)
    {
        

        $this->authorize('create-user');
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
            'cnh_due_date' => ['nullable', 'required_if:role_id,5', 'date_format:d/m/Y', 'after:today'],
            'cnh_category' => ['nullable', 'required_if:role_id,5'],
            'branch_id' => ['required', 'array', 'exists:branches,id'],
            'model_vehicle' => ['required', 'array'],
            'phone' => ['max:20'], 
            'birthday' => ['required','date_format:d/m/Y', 'before:today'], 
            'location' => ['required'], 
        ]);

        
        // Remove o campo branch_id & model_vehicle do array de dados para evitar conflito >:( fdp!!!
        $branchIds = $data['branch_id'];
        $modelVehicleIds = $data['model_vehicle'];

        unset($data['branch_id']);
        unset($data['model_vehicle']);
        
        $data['branch_id'] = $branchIds[0];
        $data['model_vehicle'] = $modelVehicleIds[0];


        
        $user = User::create($data);
        $user->cpf = preg_replace('/[^0-9]/', '', $request->get('cpf'));
        
       
        // se for motorista precisa de CNH info
        if($request->get('role_id') == 5) {
            $user->cnh_number = $request->get('cnh_number');
            $user->cnh_due_date = Carbon::createFromFormat('d/m/Y', $request->get('cnh_due_date'))->format('Y-m-d');
            $user->cnh_category = $request->get('cnh_category');
        }
        
        $user->branch()->sync($branchIds);
        $user->modelVehicle()->sync($modelVehicleIds);
        $user->save();

        return redirect()->route('user-management')->with('succes', 'User succesfully saved');
    }

    public function edit($id)
    {
        $this->authorize('edit-user');
        $user = User::with('branch')->find($id);
        $roles = Role::all();
        $branches = Branch::pluck('name', 'id');
        $selectedBranches = $user->branch->pluck('id')->toArray();  
        $selectedModels = $user->modelVehicle->pluck('name', 'id')->toArray();
        $modelVehicle = ModelVehicle::all();

        return view ('laravel.users.edit', compact('user', 'roles', 'branches', 'selectedBranches', 'selectedModels', 'modelVehicle'));
    }


    public function update(Request $request, $id)
    {
        
        $this->authorize('edit-user');

        $user = User::find($id);

        // dd($request->all());    

        $attributes = request()->validate([
            'firstname' => ['required'],
            'cpf' => ['required', Rule::unique('users', 'cpf')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'confirmation' => ['same:email'],
            'password' => [],
            'confirm-password' => ['same:password'],
            'role_id' => ['required'],
            'branch_id' => ['required', 'array', 'exists:branches,id'],
            'phone' => ['max:20'], 
            'birthday' => ['required','date_format:d/m/Y', 'before:today'], 
            'model_vehicle' => ['required', 'array'],
        ]);

        // se for motorista precisa de CNH info 
        if($request->get('role_id') == 5) {
            $user->cnh_number = $request->get('cnh_number');
            $user->cnh_due_date = Carbon::createFromFormat('d/m/Y', $request->get('cnh_due_date'))->format('Y-m-d');
            $user->cnh_category = $request->get('cnh_category');
        }

        // Remove o campo branch_id do array de dados para evitar conflito >:( fdp!!!
        $branchIds = $attributes['branch_id'];

        // Remove o campo model_vehicle do array de dados para evitar conflito >:( fdp!!!
        $modelVehicleIds = $attributes['model_vehicle'];

        unset($attributes['branch_id']);
        unset($attributes['model_vehicle']);

        $attributes['branch_id'] = $branchIds[0];
        $attributes['model_vehicle'] = $modelVehicleIds[0];

        // regex para salvar apenas o numero do cpf, sem formatação
        $cpf  = preg_replace('/[^0-9]/', '', $request->get('cpf'));
        $user->cpf = $cpf;
        
        $user->update($attributes);
        $user->branch()->sync($branchIds);
        $user->modelVehicle()->sync($modelVehicleIds);
        $user->save();

        return redirect()->route('user-management')->with('succes', 'User succesfully updated');
    }

    public function destroy($id)
    {

        $this->authorize('delete-user');
        $user = User::find($id);

        if(!$user->reservations->isEmpty()) {
            return redirect()->route('user-management')->with('error', 'Usuário não pode ser excluído. Favor entrar em contato com Administrador');
        }
        $user->delete();
        return redirect()->route('user-management')->with('succes', 'The user was succesfully deleted');
    }
}
