<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Reservation $reservation)
    {
        $reservation->load('checkins.user');
        return view('operation.checkin.create', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation,  string $id)
    {
        $checklist = Checkin::findOrFail($id);
        abort_if($reservation->getKey() != $checklist->reservation_id, 404);

        $params = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $params['user_id'] = Auth::id();
        $checklist->fill($params);
        $checklist->save();

        $reservation->load('checkins');
        $approvedCheckins = $reservation->checkins->where('status', 'approved');

        if (count($approvedCheckins) == count($reservation->checkins)) {
            return redirect()->route('reservation-management')->with('success', 'Checkin completed');
        } else {
        return redirect()->back()->with('success', 'Checkin updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
