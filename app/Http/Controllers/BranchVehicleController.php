<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class BranchVehicleController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:admin,manager')->except(['index', 'show']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branchVehicle = DB::table('branch_vehicle')
            ->join('branches', 'branch_vehicle.branch_id', '=', 'branches.id')
            ->join('vehicles', 'branch_vehicle.vehicle_id', '=', 'vehicles.id')
            ->get();

        return view('branch_vehicle.index', compact('branchVehicle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        $vehicles = Vehicle::all();
        return view('laravel.branch_vehicle.create', compact('branches', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'vehicles_id' => 'required|exists:vehicles,id',
        ]);

        DB::table('branch_vehicle')->insert([
            'branch_id' => $request->branch_id,
            'vehicle_id' => $request->vehicles_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('branch_vehicle.management')->with('success', 'Vehicle Branch created successfully.');
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
        //create edit to branch_vehicle
        $branchVehicle = DB::table('branch_vehicle')
            ->join('branches', 'branch_vehicle.branch_id', '=', 'branches.id')
            ->join('vehicles', 'branch_vehicle.vehicle_id', '=', 'vehicles.id')
            ->where('branch_vehicle.id', $id)
            ->first();
        
        return view('branch_vehicle.edit', compact('branchVehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'vehicles_id' => 'required|exists:vehicles,id',
        ]);

        DB::table('branch_vehicle')
            ->where('id', $id)
            ->update([
                'branch_id' => $request->branch_id,
                'vehicle_id' => $request->vehicles_id,
                'updated_at' => now(),
            ]);

        return redirect()->route('branch_vehicle.management')->with('success', 'Branch Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('branch_vehicle')->where('id', $id)->delete();
        
        return redirect()->route('branch_vehicle.management')->with('success', 'Branch deleted successfully.');
    }



    public function getVehicleByBranchId($id)
    {
        $data = DB::table('branch_vehicle')
            ->join('vehicles', 'branch_vehicle.vehicle_id', '=', 'vehicles.id')
            ->join('branches', 'branch_vehicle.branch_id', '=', 'branches.id')
            ->where('branch_vehicle.branch_id', $id)
            ->select('vehicles.id', 'vehicles.plate')
            ->get();

        return response()->json($data);
    }
}
