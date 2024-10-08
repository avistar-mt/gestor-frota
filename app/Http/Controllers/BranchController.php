<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\Headquarter;

class BranchController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage-branch');

        $branches = Branch::with('city', 'headquarter')->get();
        // dd($branches); 
        return view('operation.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-branch');
        $cities = City::orderBy('name')->get();
        $states = State::all();
        $headquarters = Headquarter::all();
        return view('operation.branch.create', compact('cities', 'states', 'headquarters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create-branch');

        $params = $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'headquarters_id' => 'required|exists:headquarters,id'
        ]);

        Branch::create($params);

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
        $this->authorize('edit-branch');
        $branch = Branch::find($id);
        $cities = City::all();
        $states = State::all();
        $headquarters = Headquarter::all();
        return view('operation.branch.edit', compact('branch', 'cities', 'states', 'headquarters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit-branch');

        $branch = Branch::findOrFail($id);
        $params = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|exists:cities,id',
            'headquarters_id' => 'required|exists:headquarters,id'
        ]);

        $branch->update($params);

        return redirect()->route('branch-management')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete-branch');
        $branch = Branch::findOrFail($id);

        // Check if there are vehicles linked to the branch
        if ($branch->branch_vehicles()->exists()) {
            return redirect()->route('branch-management')->with('error', 'Não é possível deletar filial com veículos vinculados.');
        }

        if($branch->branch_users()->exists()) {
            return redirect()->route('branch-management')->with('error', 'Não é possível deletar filial com usuários vinculados.');
        }

        $branch->delete();
        return redirect()->route('branch-management')->with('success', 'Branch deleted successfully.');
    }
}
