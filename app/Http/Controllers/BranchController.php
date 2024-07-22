<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\City;
use App\Models\State;
use App\Models\User;

class BranchController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     // $this->middleware('role:admin,manager')->except(['index', 'show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage-users', User::class);

        $branches = Branch::join('cities', 'cities.id', 'branches.city_id')
            ->select('branches.*', 'cities.name as city')
            ->get();
        return view('operation.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('operation.branch.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage-users', User::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|exists:cities,id'
        ]);

        Branch::create([
            'name' => $request->name,
            'city_id' => $request->city
        ]);

        return redirect()->route('branch-management')->with('success', 'Branch created successfully.');
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
        $this->authorize('manage-users', User::class);
        $branch = Branch::find($id);
        $cities = City::all();
        $states = State::all();
        return view('operation.branch.edit', compact('branch', 'cities', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id'
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update([
            'name' => $request->name,
            'city_id' => $request->city
        ]);

        return redirect()->route('branch-management')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('manage-users', User::class);
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return redirect()->route('branch-management')->with('success', 'Branch deleted successfully.');
    }
}
