<?php

namespace App\Http\Controllers;

use App\Enums\CheckoutStepType;
use App\Enums\ReservationType;
use App\Enums\StepType;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use App\Models\User;

// use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('view-reservation');
        $reservations = Reservation::orderBy('created_at', 'desc')->take(15)->get();
        return view('operation.reservation.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create-reservation');


            $user = User::find(Auth::user()->id);

            if ($user->isDriver()) {
            $drivers = User::driver()->get();
            } else {
                $drivers = User::driver()->whereDoesntHave('ownReservations', function ($query) {
                    $query->whereIn('status', ['approved', 'pending', 'ongoing']);
                })->get();
            }

            
            if($user->isDriver()) {
                $vehicles = Vehicle::query()
                ->with('branches.users')
                ->where('status', 'available')
                ->where('branch_id', $user->branch_id)
                ->whereDoesntHave('reservations', function ($query) {
                    $query->whereIn('status', ['approved', 'pending', 'ongoing']);
                })
                ->get();
            } else {

                $vehicles = Vehicle::query()
                ->with('branches')
                ->where('status', 'available')
                ->whereDoesntHave('reservations', function ($query) {
                    $query->whereIn('status', ['approved', 'pending', 'ongoing']);
                })
                ->when(Auth::user()->role->isAdminFrota() || Auth::user()->role->isGestor(), function ($query) {
                    $query->whereHas('branches', function ($query) {
                        $query->where('branches.id', Auth::user()->branch_id);
                    });
                })->get();
            }


        $branches = Branch::where('id', $user->branch_id)->get();

        return view('operation.reservation.create', compact( 'drivers', 'vehicles', 'branches', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create-reservation');
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

        foreach (StepType::cases() as $checklist) {
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

        $this->authorize('edit-reservation');
        $reservation = Reservation::find($id);
        $drivers = User::driver()->get();
        $branches = Branch::all();
        $user = auth()->user();

        $vehicles = DB::table('branch_vehicle')
            ->join('vehicles', 'branch_vehicle.vehicle_id', '=', 'vehicles.id')
            ->where('branch_vehicle.branch_id', $reservation->branch_id)
            ->select('vehicles.*')
            ->get();
        
        $reservation->vehicle = Vehicle::find($reservation->vehicle_id);


        return view('operation.reservation.edit', compact('reservation', 'branches', 'drivers', 'user', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->authorize('manage-reservation', Reservation::class);

        $request->validate([
            'status' => ['required', Rule::enum(ReservationType::class)],
            'motive' => ['nullable', 'string', 'required_if:status,canceled']
        ]);

        $reservation = Reservation::find($id);

        if ($request->status == 'canceled') {
            // $request->validate(['motive' => 'required|string']);
            $reservation->motive = $request->motive;
            $reservation->status = $request->status;
        }

        if ($request->status == 'approved') {
            $reservation->status = $request->status;
            $reservation->motive = null;
            $reservation->approved_by = Auth::user()->id;
        }

        if ($reservation->save()) {
            if ($request->status == 'approved') {
                foreach (CheckoutStepType::cases() as $checklist) {
                    $reservation->checkouts()->create(['step' => $checklist]);
                }
            }
        }

        return redirect()->route('reservation-management')->with('success', 'Reserva atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete-reservation', Reservation::class);
        $reservation = Reservation::findOrFail($id);

        $reservation->checkins()->delete();
        $reservation->delete();

        return redirect()->route('reservation-management')->with('success', 'Reserva deletada com sucesso.');
    }

    public function reportForm()
    {
        
        $this->authorize('report-reservation', Reservation::class);
        $users = User::all();


        return view('operation.reservation.report', compact('users'));
    }


    public function generateReport(Request $request)
    {

        $this->authorize('report-reservation');
        $request->validate(
            [
                'start_date' => 'required|before_or_equal:end_date|date_format:d/m/Y',
                'end_date' => 'required|after_or_equal:start_date|date_format:d/m/Y',
                'solicitante' => 'nullable|exists:users,id',
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


        $query = Reservation::query();

        $query->where('reservation_star', '>=', Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay());
        $query->where('reservation_end', '<=', Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay());

        if (!empty($request->solicitante)) {
            $query->where('user_id', $request->solicitante);
        } else {
            $query->where('user_id', auth()->user()->id);
        }

        $reservations = $query->get();
        $users = User::all();


        return view('operation.reservation.report', compact('reservations', 'users'))->with('success', 'Relatório gerado com sucesso.');
    }


    public function exportReport(Request $request)
    {
        $this->authorize('report-reservation');
        $request->validate([
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y|after_or_equal:start_date',
            'solicitante' => 'nullable|string'
        ]);

        $query = Reservation::query();

        $query->where('reservation_start', '>=', Carbon::createFromFormat('d/m/Y', $request->start_date)->startOfDay());
        $query->where('reservation_end', '<=', Carbon::createFromFormat('d/m/Y', $request->end_date)->endOfDay());

        if (!empty($request->solicitante)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('id',  $request->solicitante);
            });
        } else {
            $query->where('user_id', auth()->user()->id);
        }

        

        $reservations = $query->get();

        return Excel::download(new ReservationsExport($reservations), 'report.xlsx');
    }
}
