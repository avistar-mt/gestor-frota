<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Reservation;
use App\Models\Branch;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{
    public function index()
    {

        $totalVehicle = Vehicle::count();
        $totalBranch = Branch::count();
        $totalDriver = Driver::count();
        $latestReservation = Reservation::orderBy('created_at', 'desc')->take(15)->get();

        $branchReservation = Reservation::select('branch_id', DB::raw('count(*) as total'))
            ->groupBy('branch_id')
            ->get();


        return view('dashboards.default', compact('totalVehicle', 'totalBranch', 'totalDriver','latestReservation', 'branchReservation'));
    }
}
