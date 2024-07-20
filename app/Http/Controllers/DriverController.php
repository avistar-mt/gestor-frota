<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\User;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();
        $this->authorize('manage-drivers', User::class);
        $drivers = Driver::all();
        return view('laravel.driver.index', compact('drivers', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laravel.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
            'cpf'=> 'required|string|max:14|unique:drivers',
            'phone'=> 'required|string|max:15',
            'status'=> 'required|in:active,inactive',
            'birth_date'=> 'required|date',
            'cnh_number'=> 'required|string|max:20|unique:drivers',
            'cnh_due_date'=> 'required|date',
            'cnh_category'=> 'required|string',
            'street'=> 'required|string|max:255',
            'number'=> 'required|string|max:10',
            'city'=> 'required|string|max:255',
            'state'=> 'required|string|max:20',
        ]);

        Driver::create($validatedData);

        return redirect()->route('driver-management')->with('success', 'Driver created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $this->authorize('manage-drivers', User::class);
        $driver = Driver::findOrFail($id);
        return view('laravel.driver.edit', compact('user', 'driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $driver = Driver::findOrFail($id);

        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
            'cpf'=> 'required|string|max:14|unique:drivers',
            'phone'=> 'required|string|max:15',
            'status'=> 'required|in:active,inactive',
            'birth_date'=> 'required|date',
            'cnh_number'=> 'required|string|max:20|unique:drivers',
            'cnh_due_date'=> 'required|date',
            'cnh_category'=> 'required|string|max:2',
            'street'=> 'required|string|max:255',
            'number'=> 'required|string|max:10',
            'city'=> 'required|string|max:255',
            'state'=> 'required|string|max:20',
        ]);

        $driver->update($validatedData);

        return redirect()->route('driver-management')->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->route('driver-management')->with('success', 'Driver deleted successfully.');
    }
}
