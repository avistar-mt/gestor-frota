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
use App\Models\User;

// use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('view-reservation', Reservation::class);
        $reservations = Reservation::orderBy('created_at', 'desc')->get();

        return view('operation.reservation.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $user = auth()->user();
        $drivers = User::where('role_id', 5)->whereDoesntHave('ownReservations', function ($query) {
            $query->whereIn('status', ['approved', 'pending', 'ongoing']);
        })->get();


        $branches = [];
        if ($user->role->isAdminFrota() || $user->role->isGestor()){
            $branches = Branch::with('vehicles')->get();
        } else {
            $branches = Branch::with('vehicles')->where('id', $user->branch_id)->get();
        }
        

        $vehicles = [];
        if ($user->role->isAdminFrota() || $user->role->isGestor()) {
            $vehicles = Vehicle::all()
                                ->where('status', 'available')
                                ->whereDoesntHave('reservations', function ($query) {
                                        $query->whereIn('status', ['approved', 'pending', 'ongoing']);
                                 });
        } else {
            $vehicles = Vehicle::where('status', 'available')
                ->whereDoesntHave('reservations', function ($query) {
                    $query->whereIn('status', ['approved', 'pending', 'ongoing']);
                })
                ->whereHas('branches', function ($query) use ($user) {
                    $query->where('branches.id', $user->branch_id);
                })
                ->get();
        }
        

        return view('operation.reservation.create', compact('branches', 'drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'driver_id' => 'required|exists:users,id',
            'reservation_star' => 'required|after:now|date_format:d/m/Y H:i',
            'reservation_end' => 'required|after:reservation_star|date_format:d/m/Y H:i',
            'branch_id' => 'required|exists:branches,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

       $reservation =  Reservation::create(
            [
                'driver_id' => $request->driver_id,
                'reservation_star' => $request->reservation_star,
                'reservation_end' => $request->reservation_end,
                'branch_id' => $request->branch_id,
                'vehicle_id' => $request->vehicle_id,
                'user_id' => auth()->user()->id, 
            ]
        );

        foreach (['wheels', 'bodywork', 'lights', 'document'] as $checklist) {
            $reservation->checkins()->create(['step' => $checklist]);
        }

        return redirect()->route('reservation-checkin', $reservation);
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

        $this->authorize('manage-reservation', Reservation::class);
        $reservation = Reservation::find($id);
        $drivers = User::where('role_id', 5)->get();
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

        $this->authorize('manage-reservation', Reservation::class);

        $request->validate([
            'status' => 'required|in:pending,approved,canceled, completed, disapproved, ongoing',
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
        $reservation->checkins()->delete();
        $reservation->delete();

        return redirect()->route('reservation-management')->with('success', 'Reserva deletada com sucesso.');
    }

    public function reportForm()
    {
        $users = User::all();
        return view('operation.reservation.report', compact('users'));
    }


    public function generateReport(Request $request)
{

    $request->validate(
        [
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|after_or_equal:start_date|date_format:d/m/Y',
            'solicitante' => 'nullable|string',
            'output_type' => 'nullable|string|in:pdf,excel',
        ],
        [
            'start_date.required' => 'A data de início é obrigatória.',
            'start_date.date_format' => 'A data de início deve estar no formato dd/mm/aaaa.',
            'end_date.required' => 'A data de término é obrigatória.',
            'end_date.date_format' => 'A data de término deve estar no formato dd/mm/aaaa.',
            'end_date.after' => 'A data fim não pode ser maior que a data de início.',
            'output_type.in' => 'O tipo de saída deve ser pdf ou excel.',
        ]
    );

    $users = User::all();
    $query = Reservation::query();

    $query->where('reservation_star', '>=', Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay());
    $query->where('reservation_end', '<=', Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay());

    if (!empty($request->solicitante)) {
        $query->where('user_id', $request->solicitante);
    } else {
        $query->where('user_id', auth()->user()->id);
    }

    $reservations = $query->get();    

    return view('operation.reservation.report', compact('reservations', 'users'))->with('success', 'Relatório gerado com sucesso.');
}


    public function exportReport(Request $request) 
    {

        $request->validate([
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y|after_or_equal:start_date', 
            'solicitante' => 'nullable|string'
        ]);

        $query = Reservation::query();

        $query->where('reservation_start', '>=', Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay());
        $query->where('reservation_end', '<=', Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay());

        if (!empty($request->solicitante)) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('id',  $request->solicitante);
            });
        } else {
            $query->where('user_id', auth()->user()->id);
        }

        $reservations = $query->get();

        return Excel::download(new ReservationsExport($reservations), 'report.xlsx');
    }
}