<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();
        $this->authorize('manage-drivers', User::class);
        $drivers = Driver::where('status', 'active')->get();
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

        $request->validate([
            'name'=> 'required|string|max:255',
            'cpf'=> 'required|string|max:14|unique:drivers',
            'phone'=> 'required|string|max:15',
            'status'=> 'required|in:active,inactive',
            'birth_date'=> 'required|date_format:d/m/Y',
            'cnh_number'=> 'required|string|max:20|unique:drivers',
            'cnh_due_date'=> 'required|date_format:d/m/Y',
            'cnh_category'=> 'required|string',
            'street'=> 'required|string|max:255',
            'number'=> 'required|string|max:10',
            'city'=> 'required|string|max:255',
            'state'=> 'required|string|max:20',
        ]);

        $data = $request->all();

        Driver::create($data);

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
            'cpf'=> ['required', Rule::unique('drivers', 'cpf')->ignore($driver->id)],
            'phone'=> 'required|string|max:15',
            'status'=> 'required|in:active,inactive',
            'birth_date'=> 'required|date_format:d/m/Y',
            'cnh_number'=> ['required', Rule::unique('drivers', 'cnh_number')->ignore($driver->id)],
            'cnh_due_date'=> 'required|date_format:d/m/Y',
            'cnh_category'=> 'required|string|max:2',
            'street'=> 'required|string|max:255',
            'number'=> 'required|string|max:10',
            'city'=> 'required|string|max:255',
            'state'=> 'required|string|max:20',
        ]);

        // $validatedData['birth_date'] = Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d');
        // $validatedData['cnh_due_date'] = Carbon::createFromFormat('d/m/Y', $request->cnh_due_date)->format('Y-m-d');

        $driver->update($validatedData);

        return redirect()->route('driver-management')->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $driver = Driver::findOrFail($id);

        $driver->status = 'inactive';
        $driver->save();

        return redirect()->route('driver-management')->with('success', 'Driver deleted successfully.');
    }
}
