<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Driver;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Enums\ReservationStatus;



class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();

        return view('laravel.reservation.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        $drivers = Driver::all();

        return view('laravel.reservation.create', compact('branches', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'reservation_star' => 'required|date|after:now',
            'reservation_end' => 'required|date|after:reservation_star',
            'branch_id' => 'required|exists:branches,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);


        $reservation = new Reservation();
        $reservation->driver_id = $request->driver_id;
        $reservation->reservation_star = Carbon::createFromFormat('d-m-Y H:i', $request->reservation_star, 'America/Sao_Paulo')->format('Y-m-d H:i:s');
        $reservation->reservation_end = Carbon::createFromFormat('d-m-Y H:i', $request->reservation_end, 'America/Sao_Paulo')->format('Y-m-d H:i:s');
        $reservation->branch_id = $request->branch_id;
        $reservation->vehicle_id = $request->vehicle_id;
        $reservation->user_id = auth()->user()->id;

        $reservation->save();

        return redirect()->route('reservation-management')->with('success', 'Reservation created successfully.');
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
        $reservation = Reservation::find($id);
        $drivers = Driver::all();
        $branches = Branch::all();
        $user = auth()->user();

        $vehicles = DB::table('branch_vehicle')
            ->join('vehicles', 'branch_vehicle.vehicle_id', '=', 'vehicles.id')
            ->where('branch_id', $reservation->branch_id)
            ->select('vehicles.*')
            ->get();


        return view('laravel.reservation.edit', compact('reservation', 'branches', 'drivers', 'user', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,cancelled',
        ]);

        $reservation = Reservation::find($id);

        if ($request->status == 'rejected') {
            $request->validate(['motive' => 'required|string']);
            $reservation->motive = $request->motive;
        }

        if ($request->status == 'approved') {
            $reservation->approved_by = auth()->user()->id;
        }

        $reservation->save();

        return redirect()->route('reservation-management')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('reservation-management')->with('success', 'Reservation deleted successfully.');
    }
}
