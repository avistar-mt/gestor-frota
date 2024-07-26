<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debit;
use App\Models\Reservation;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debits = Debit::orderBy('created_at', 'desc')->get();
        return view('operation.debit.index', compact('debits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservations = Reservation::all();
        // dd($reservations);
        return view('operation.debit.create', compact('reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:d/m/Y',
            'description' => 'required|string',
            'type' => 'required|string',
            'image_path' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $data['image_path'] = 'images/'.$imageName;
        }

        Debit::create($data);
        return redirect()->route('debit-management')->with('success', 'Debit created successfully.');
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
        $reservations = Reservation::all();
        $debit = Debit::find($id);
        return view('operation.debit.edit', compact('debit', 'reservations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $data = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:d/m/Y',
            'description' => 'required|string',
            'type' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $debit = Debit::find($id);

        if($request->hasFile('image_path')) {
            if (isset($debit->image_path)) {
                return back()->with('error', 'Você não pode adicionar nova imagem, por favor delete a anterior.')->withInput();
            }
        }


        // Deletar imagem anterior
        if ($request->input('delete_image')) {
            if (isset($debit->image_path)) {
            unlink(public_path("/{$debit->image_path}"));
            $debit->image_path = null;
            }
        }


        //Atualizar imagem
        if($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);    
            $data['image_path'] = 'images/'.$imageName;
        }

        $debit = Debit::find($id);
        $debit->update($data);
        return redirect()->route('debit-management')->with('success', 'Debit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $debit = Debit::find($id);
        if($debit->image_path) {
            unlink(public_path('images/'.$debit->image_path));
        }

        $debit->delete();
        return redirect()->route('debit-management')->with('success', 'Debit deleted successfully.');
    }
}
