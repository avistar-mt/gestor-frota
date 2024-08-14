<?php

namespace App\Http\Controllers;

use App\Enums\ReservationType;
use App\Enums\Stage;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Reservation $reservation)
    {
        $reservation->load('checkouts.user');
        return view('operation.checkout.index', compact('reservation'));
    }

    /**
     * Display a listing of the resource.
     */
    public function edit(Reservation $reservation, string $id)
    {
        $checkout = Checkout::findOrFail($id);
        abort_if($reservation->getKey() != $checkout->reservation_id, 404);

        $checkout->load('reservation');
        return view('operation.checkout.edit', compact('checkout'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation, string $id)
    {
        $checklist = Checkout::findOrFail($id);
        // TODO: prevent recheckout item
        abort_if($reservation->getKey() != $checklist->reservation_id, 404);

        $params = $request->validate([
            'status' => ['required', Rule::in([Stage::APROVADO->value, Stage::NEGADO->value])],
            'image' => ['required', 'file', 'image']
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);    
        $params['image'] = 'images/'.$imageName;

        $params['user_id'] = Auth::id();
        $checklist->fill($params);
        $checklist->save();

        $reservation->load('checkouts');
        $approvedCheckouts = $reservation->checkouts()->where('status', 'approved')->get();
        // dd($approvedCheckouts);
        if (count($approvedCheckouts) == count($reservation->checkouts)) {
            // TODO: finish reservation
            $reservation->status = ReservationType::COMPLETADO;
            $reservation->save();
            
            return redirect()->route('reservation-management')->with('success', 'Checkout completed');
        } else {
            return redirect()->route('reservation-checkout', $reservation->getKey())->with('success', 'Checkout updated');
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
