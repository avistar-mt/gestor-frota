<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Reservation;
use App\Models\Branch;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->isDriver()) {
            return redirect()->route('reservation-management');
        }

        $totalVehicle = Vehicle::count();
        $totalBranch = Branch::count();
        $totalDriver = User::driver()->count();
        $latestReservation = Reservation::with('driver', 'vehicle')->latest()->take(15)->get();
        $reservations = Reservation::all()->map(function ($reservation) {
            return [
                'title' => "{$reservation->id}/{$reservation->driver->name} {$reservation->vehicle->plate}",
                'start' => $reservation->reservation_star->format('Y-m-d'),
                'className' => "bg-gradient-{$reservation->status->color()}",
            ];
        });

        $branchReservation = Reservation::select('branch_id', DB::raw('count(*) as total'))
            ->groupBy('branch_id')
            ->get();

        $last24Hours = Reservation::where('created_at', '>=', now()->subDay())
            ->count();

        return view('dashboards.default', compact('totalVehicle', 'totalBranch', 'totalDriver','latestReservation', 'branchReservation', 'last24Hours', 'reservations'));
    }
}
