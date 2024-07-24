<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Driver;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('manage-reservation', Reservation::class);
        $reservations = Reservation::orderBy('created_at', 'desc')->get();

        return view('operation.reservation.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $user = auth()->user();
        $drivers = Driver::all();


        $branches = [];
        if ($user->role->isAdminFrota() || $user->role->isGestor()){
            $branches = Branch::with('vehicles')->get();
        } else {
            $branches = Branch::with('vehicles')->where('id', $user->branch_id)->get();
        }
        

        $vehicles = [];
        if ($user->role->isAdminFrota() || $user->role->isGestor()) {
            $vehicles = Vehicle::all()->where('status', 'available');
        } else {
            $vehicles = Vehicle::where('status', 'available')->whereHas('branches', function ($query) use ($user) {
                $query->where('branches.id', $user->branch_id);
            })->get();
        }
        

        return view('operation.reservation.create', compact('branches', 'drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'reservation_star' => 'required|after:now|date_format:d/m/Y H:i',
            'reservation_end' => 'required|after:reservation_star|date_format:d/m/Y H:i',
            'branch_id' => 'required|exists:branches,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        Reservation::create(
            [
                'driver_id' => $request->driver_id,
                'reservation_star' => $request->reservation_star,
                'reservation_end' => $request->reservation_end,
                'branch_id' => $request->branch_id,
                'vehicle_id' => $request->vehicle_id,
                'user_id' => auth()->user()->id, 
                'status' => 'pending',
            ]
        );

        return redirect()->route('reservation-management')->with('success', 'Reserva criada com sucesso.');
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


        return view('operation.reservation.edit', compact('reservation', 'branches', 'drivers', 'user', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,canceled',
        ]);

        $reservation = Reservation::find($id);

        if ($request->status == 'canceled') {
            $request->validate(['motive' => 'required|string']);
            $reservation->motive = $request->motive;
            $reservation->status = $request->status;
        }

        if ($request->status == 'approved') {
            $reservation->status = $request->status;
            $reservation->motive = null;
            $reservation->approved_by = Auth::user()->id;
        }

        $reservation->save();

        return redirect()->route('reservation-management')->with('success', 'Reserva atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('reservation-management')->with('success', 'Reserva deletada com sucesso.');
    }
}
