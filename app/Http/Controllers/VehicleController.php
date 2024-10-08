<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use Illuminate\Validation\Rule;
use App\Models\Vehicle;
use App\Models\ModelVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage-vehicle');

        $user = Auth::user();
        $vehicles = Vehicle::all();


        return view('laravel.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('create-vehicle');

        $branches = Branch::all();
        $modelVehicle = ModelVehicle::all();
        return view('laravel.vehicle.create', compact('branches', 'modelVehicle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $this->authorize('create-vehicle');

    $params = $request->validate([
        'plate' => 'required|string|max:20|unique:vehicles,plate',
        'model' => 'required|string|max:255',
        'year' => ['required', 'string', 'max:255', 'regex:/^\d{4}$/'],
        'color' => 'required|string|max:255',
        'renavam' => 'required|string|max:255',
        'description' => 'string|max:255',
        'tracker_number' => 'required|string|max:255',
        'branch_id' => 'required|exists:branches,id',
    ]);
    
    

    $branchIds = $params['branch_id'];
    unset($params['branch_id']);
    $params['branch_id'] = $branchIds[0];
    
    $vehicle = Vehicle::create($params);  
    $vehicle->branches()->sync($branchIds);
    $vehicle->save();


    return redirect()->route('vehicle-management')
        ->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $this->authorize('edit-vehicle');   
        $vehicle = Vehicle::findOrFail($id);
        $branches = Branch::pluck('name', 'id');
        $modelVehicle = ModelVehicle::all();
        return view('laravel.vehicle.edit', compact('vehicle', 'branches', 'modelVehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->authorize('edit-vehicle');
        // dd($request->all());
        // if (!$this->match_year($request->year)) {
        //     return redirect()->back()->withErrors(['year' => 'Invalid year format.'])->withInput();
        // }
       
        // $status = '';
        // if ($request->status == StatusType::DISPONIVEL || $request->status == StatusType::ALUGADO || $request->status == StatusType::MANUTENCAO) {
        //     $status = $request->status;
        // } else {
        //     return redirect()->back()->withErrors(['status' => 'Invalid status.'])->withInput();
        // }

        $params = $request->validate([
            'plate' => 'required|string|max:20|unique:vehicles,plate,'.$id,
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'renavam' => 'required|string|max:255',
            'description' => 'string|max:255',
            'tracker_number' => 'required|string|max:255', 
            'status' => ['required', 'string', 'max:50', Rule::enum(StatusType::class)], 
            'branch_id' => 'required|exists:branches,id',
        ]);


        $branchIds = $params['branch_id'];
        unset($params['branch_id']);
        $params['branch_id'] = $branchIds[0];


        $vehicle  = Vehicle::find($id);
        $vehicle->update($params);
        $vehicle->branches()->sync($branchIds);
        $vehicle->save();

        return redirect()->route('vehicle-management')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $this->authorize('delete-vehicle');
        $vehicle = Vehicle::findOrFail($id);


        if ($vehicle->reservations->count() > 0) {
            return redirect()->route('vehicle-management')
                ->with('error', 'Veículo não pode ser excluído. Favor entrar em contato com Administrador');
        }
        $vehicle->delete();

        return redirect()->route('vehicle-management')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
