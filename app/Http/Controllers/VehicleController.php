<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use Illuminate\Validation\Rule;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            $vehicles = Vehicle::all();
        } else if ($user->role_id == 2) {
            $vehicles = DB::table('branch_vehicles')
                ->join('vehicles', 'branch_vehicles.vehicle_id', '=', 'vehicles.id')
                ->where('branch_vehicles.branch_id', $user->branch_id)
                ->where('vehicles.status', StatusType::DISPONIVEL)
                ->select('vehicles.*')
                ->get();
        } else {
            return redirect('/')->with('error', 'Você não tem permissão para acessar essa página.');
        }

        return view('laravel.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laravel.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $status = '';
        // if ($request->status == StatusType::DISPONIVEL || $request->status == StatusType::ALUGADO || $request->status == StatusType::MANUTENCAO) {
        //     $status = $request->status;
        // } else {
        //     return redirect()->route('vehicles.management')
        //         ->with('error', 'Status invalid.');
        // }

        if (!$this->match_year($request->year)) {
            return redirect()->back()->withErrors(['year' => 'Invalid year format.'])->withInput();
        }

    // $plate = $this->sanitize_plate($request->plate);

    $request->validate([
        'plate' => 'required|string|max:20|unique:vehicles',
        'model' => 'required|string|max:255',
        'year' => 'required|string|max:255',
        'color' => 'required|string|max:255',
        'renavam' => 'required|string|max:255',
        'description' => 'string|max:255',
        'tracker_number' => 'required|string|max:255'
    ]);

    $plate = $this->sanitize_plate($request->plate);

    Vehicle::create([
        'plate' => $plate,
        'model' => $request->model,
        'year' => $request->year,
        'color' => $request->color,
        'renavam' => $request->renavam,
        'description' => $request->description,
        'tracker_number' => $request->tracker_number
    ]);

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
        $vehicle = Vehicle::findOrFail($id);
        return view('laravel.vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        if (!$this->match_year($request->year)) {
            return redirect()->back()->withErrors(['year' => 'Invalid year format.'])->withInput();
        }
       
        // $status = '';
        // if ($request->status == StatusType::DISPONIVEL || $request->status == StatusType::ALUGADO || $request->status == StatusType::MANUTENCAO) {
        //     $status = $request->status;
        // } else {
        //     return redirect()->back()->withErrors(['status' => 'Invalid status.'])->withInput();
        // }

        $request->validate([
            'plate' => 'required|string|max:20|unique:vehicles,plate,'.$id,
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'renavam' => 'required|string|max:255',
            'description' => 'string|max:255',
            'tracker_number' => 'required|string|max:255', 
            'status' => ['required', 'string', 'max:50', Rule::in([StatusType::DISPONIVEL, StatusType::ALUGADO, StatusType::MANUTENCAO])]
        ]);

        Vehicle::findOrFail($id)->update($request->all());

        return redirect()->route('vehicle-management')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);


        if ($vehicle->reservations->count() > 0) {
            return redirect()->route('vehicle-management')
                ->with('error', 'Veículo não pode ser excluído. Favor entrar em contato com Administrador');
        }
        $vehicle->delete();

        return redirect()->route('vehicle-management')
            ->with('success', 'Vehicle deleted successfully.');
    }

    public function sanitize_plate($plate) 
    {
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $plate));
    }

    public function match_year($year) 
    {
        return preg_match('/^\d{4}$/', $year);
    }
}
