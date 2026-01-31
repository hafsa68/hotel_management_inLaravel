<?php

namespace App\Http\Controllers;

use App\Models\Booking; // Changed to Booking model
use App\Models\Room;
use App\Models\RoomNo;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $roomTypes = Room::all();
        return view('backend.book.index', compact('roomTypes'));
    }

    public function search(Request $request) 
    {
        $roomId = $request->rooms_id; 
        
        // 1. Validate Date Selection
        if(!$request->dates) {
             return redirect()->back()->with('error', 'Please select a date range!');
        }

        $dates = explode(' - ', $request->dates);
        
        if(count($dates) < 2) {
            return redirect()->back()->with('error', 'Invalid date selection!');
        }

        $checkIn = date('Y-m-d', strtotime($dates[0]));
        $checkOut = date('Y-m-d', strtotime($dates[1]));

        $roomTypes = Room::all();
        $selectedRoomType = Room::find($roomId);

        // 2. CRITICAL FIX: Changed 'rooms_id' to 'room_id'
        // This matches the column name in your database, fixing the SQL error.
        $allRoomNumbers = RoomNo::where('room_id', $roomId)->get();

        // 3. Find Booked Rooms using Booking Model
        $bookedRoomIds = Booking::where(function($query) use ($checkIn, $checkOut) {
            $query->whereBetween('check_in', [$checkIn, $checkOut])
                  ->orWhereBetween('check_out', [$checkIn, $checkOut])
                  ->orWhere(function($sub) use ($checkIn, $checkOut){
                      $sub->where('check_in', '<=', $checkIn)
                          ->where('check_out', '>=', $checkOut);
                  });
        })->pluck('room_nos_id')->toArray();

        return view('backend.book.index', compact('allRoomNumbers', 'bookedRoomIds', 'checkIn', 'checkOut', 'roomTypes', 'selectedRoomType'));
    }

    // The store method is removed because we moved it to BookingController
    // to keep logic clean (Search vs Storage).

    public function getRoomCount($id)
    {
        // 4. CRITICAL FIX: Changed 'rooms_id' to 'room_id' here too
        $count = RoomNo::where('room_id', $id)->count();
        return response()->json(['count' => $count]);
    }

    
}