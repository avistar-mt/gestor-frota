<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,cancelled',
            'motive' => 'nullable|string'
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;

        if($request->status == 'rejected') {
            $request->validate(['motive' => 'required|string']);
            $reservation->motive = $request->motive;
        }

        $reservation->approved_by = auth()->user()->id;
        $reservation->save();

        return redirect()->route('reservation.index')->with('success', 'Reservation status updated successfully.');
    }
}
