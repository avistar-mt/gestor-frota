<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\BranchVehicle;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class BranchVehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branchVehicles  = Branch::with('vehicles')->get();
    
        return view('laravel.branch_vehicle.index', compact('branchVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        $vehicles = Vehicle::pluck('plate', 'id');
        return view('laravel.branch_vehicle.create', compact('branches', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch' => 'required|exists:branches,id',
            'vehicles' => 'required|array',
            'vehicles.*' => 'exists:vehicles,id',
        ]);

        $branch = Branch::find($request->get('branch'));
        $branch->vehicles()->sync($request->get('vehicles'));

        return redirect()->route('branch-vehicle-management')->with('success', 'Vehicle Branch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branchVehicle = Branch::with('vehicles')->findOrFail($id);
        $vehicles = Vehicle::pluck('plate', 'id');
        $selectedVehicles = $branchVehicle->vehicles->pluck('id')->toArray();

        // dd($branchVehicle);
        
        return view('laravel.branch_vehicle.edit', compact('branchVehicle', 'vehicles', 'selectedVehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch' => 'required|exists:branches,id',
            'vehicles' => 'required|array',
            'vehicles.*' => 'exists:vehicles,id',
        ]);

        $branch = Branch::findOrFail($request->get('branch'));
        $branch->vehicles()->sync($request->get('vehicles'));

    
        return redirect()->route('branch-vehicle-management')->with('success', 'Branch Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BranchVehicle::destroy($id);
        
        return redirect()->route('branch-vehicle-management')->with('success', 'Branch deleted successfully.');
    }



    public function getVehicleByBranchId($id)
    {
    //     $data = DB::table('branch_vehicle')
    //         ->join('vehicles', 'branch_vehicle.vehicle_id', '=', 'vehicles.id')
    //         ->join('branches', 'branch_vehicle.branch_id', '=', 'branches.id')
    //         ->where('branch_vehicle.branch_id', $id)
    //         ->select('vehicles.id', 'vehicles.plate')
    //         ->get();

        $data = Vehicle::with('branch')->where('branch_id', $id)->select('vehicles.id', 'vehicles.plate')->get();

        return response()->json($data);
    }
}
