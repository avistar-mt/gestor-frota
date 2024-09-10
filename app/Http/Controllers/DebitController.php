<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debit;
use App\Models\Reservation;
use Illuminate\Support\Facades\Storage;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage-debit');
        $debits = Debit::orderBy('created_at', 'desc')->get();
        return view('operation.debit.index', compact('debits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-debit');
        $reservations = Reservation::all();
        // dd($reservations);
        return view('operation.debit.create', compact('reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create-debit');
        $data = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:d/m/Y',
            'description' => 'required|string',
            'type' => 'required|string',
            'image_path' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $debit = Debit::create($data);
        if($request->hasFile('image_path')) {
            $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
            
            $file = $request->file('image_path');
            $filename = $file->getClientOriginalName();
            $path = "$folderId/$filename";
            $stream = fopen($file->getRealPath(), 'r+'); 

            Storage::disk('google')->writeStream($path, $stream);

            //save new path in the database
            $debit->image_path = $path;
            $debit->save();
        }

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
        $this->authorize('edit-debit');
        $reservations = Reservation::all();
        $debit = Debit::find($id);
        return view('operation.debit.edit', compact('debit', 'reservations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request);
        $this->authorize('edit-debit');
        $data = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:d/m/Y',
            'description' => 'required|string',
            'type' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $debit = Debit::findOrFail($id);

        // Verificar se a imagem deve ser deletada
        if ($request->has('delete_image')) {
            if (Storage::disk('google')->has($debit->image_path)) {
                Storage::disk('google')->delete($debit->image_path);
            }
            $debit->image_path = null;
        }

        if($request->file('image_path')) {

            $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
            $file = $request->file('image_path');
            $filename = $file->getClientOriginalName();
            $path = "$folderId/$filename";
            $stream = fopen($file->getRealPath(), 'r+');

            if (Storage::disk('google')->has($path)) {
                    Storage::disk('google')->delete($path); // Remove o arquivo anterior
                    Storage::disk('google')->writeStream($path, $stream); // Substitui pelo novo arquivo
            }

            $data['image_path'] = $path;
        }
        
        $debit->update($data);
        return redirect()->route('debit-management')->with('success', 'Debit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete-debit');
        $debit = Debit::findOrFail($id);

        $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
        $path = "$folderId/$debit->image_path";

        if(Storage::disk('google')->has($path)) {
            Storage::disk('google')->delete($path);
        }

        $debit->delete();
        return redirect()->route('debit-management')->with('success', 'Debit deleted successfully.');
    }

    public function showThumbnail($path)
{
    // Verificar se o arquivo existe no Google Drive
    if (Storage::disk('google')->has($path)) {
        $content = Storage::disk('google')->get($path);
        $mime = Storage::disk('google')->mimeType($path);

        return response($content)
            ->header('Content-Type', $mime);
    }

    return response()->json(['message' => 'Arquivo não encontrado'], 404);
}
}
