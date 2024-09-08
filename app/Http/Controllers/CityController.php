<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage-city');
        $cities = City::with('state')->get();
        return view('laravel.city.index', compact('cities'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-city');
        $states = State::all();
        return view('laravel.city.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create-city');
        $request->validate([
            'name' => 'required|string|max:255',
            'state' => 'required|exists:states,id'
        ]);

        City::create([
            'name' => $request->name,
            'state_id' => $request->state
        ]);

        return redirect()->route('city-management')->with('success', 'City created successfully.');
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
        $this->authorize('edit-city');
        $city = City::find($id);
        $states = State::all();
        return view('laravel.city.edit', compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit-city');
        $request->validate([
            'name' => 'required|string|max:255',
            'state' => 'required|exists:states,id'
        ]);

        $city = City::findOrFail($id);
        $city->name = $request->name;
        $city->state_id = $request->state;
        $city->save();

        return redirect()->route('city-management')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete-city');
        $city = City::findOrFail($id);

        if(!$city->branches->isEmpty()) {
            return redirect()->route('city-management')->with('error', 'Essa cidade possui filiais e não pode ser excluída. Favor entre em contato com o administrador.');
        }

        $city->delete();
        
        return redirect()->route('city-management')->with('success', 'City deleted successfully.');
    }
}
