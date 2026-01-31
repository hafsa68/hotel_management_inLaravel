<?php

namespace App\Http\Controllers;

use App\Models\RoomNo;
use Illuminate\Http\Request;

class RoomNoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index($room_id)
{
    
    $roomType = \App\Models\Room::with('roomNumbers')->findOrFail($room_id);
    
    
    return view('backend.room_no.index', compact('roomType'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($room_id)
{
    
    $roomType = \App\Models\Room::findOrFail($room_id);

    
    return view('backend.room_no.create', compact('roomType'));
}

    /**
     * Store a newly created resource in storage.
     */
    


    public function store(Request $request)
{
    
    $request->validate([
        'room_id' => 'required',
        'room_number' => 'required|unique:room_nos,room_number', 
        'status' => 'required'
    ]);

    
    RoomNo::create([
        'room_id' => $request->room_id,
        'room_number' => $request->room_number,
        'status' => $request->status,
    ]);

    
    return redirect()->back()->with('success', 'Room Number added successfully!');
}
    /**
     * Display the specified resource.
     */
    public function show(RoomNo $roomNo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    
public function edit($id)
{
    $roomNo = RoomNo::findOrFail($id);
    return response()->json($roomNo);
}


public function update(Request $request, $id)
{
    $request->validate([
        'room_number' => 'required',
        'status' => 'required'
    ]);

    $roomNo = RoomNo::findOrFail($id);
    $roomNo->update([
        'room_number' => $request->room_number,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Room Number updated successfully!');
}


public function destroy($id)
{
    $roomNo = RoomNo::findOrFail($id);
    $roomNo->delete();
    return redirect()->back()->with('success', 'Room Number deleted successfully!');
}
}