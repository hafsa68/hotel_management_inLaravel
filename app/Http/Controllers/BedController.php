<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use Illuminate\Http\Request;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Bed::get();
        return view('backend.bed.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.bed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'bed_type' => 'required|string|max:100|min:3',
            'status' => 'required|in:Enabled,Disabled',
            'icon' => 'nullable|string|max:100',
        ]);

          Bed::create($validated);
        return redirect()->route('bed.index')->with('success', 'New Bed Type Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bed $bed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bed $bed)
    {
         return view('backend.bed.edit', compact('bed'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bed $bed)
    {
        
        $request->validate([
            'bed_type' => 'required|string|max:100',
            'status' => 'required|in:Enabled,Disabled',
            'icon' => 'nullable|string|max:100',
        ]);

         $data = [
            'bed' => $request->bed,
            'status' => $request->status,
            'icon' => $request->icon,

        ];

        $bed->update($data);
        return redirect()->route('bed.index')->with('success', 'Bed Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bed $bed)
    {
        

        $bed->delete();

        return redirect()->route('bed.index')->with('success', 'Bed Type deleted');
    }

     public function statusToggle(Request $request)
    {
        $bed = Bed::findOrFail($request->id);

        $bed->status = $bed->status == 'Enabled' ? 'Disabled' : 'Enabled';
        $bed->save();

        return response()->json([
            'status' => $bed->status
        ]);
    }
}
