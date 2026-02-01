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

        // 2. Get all rooms of this type
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

        // ✅ লজিক: একসাথে সব ডাটা
        $roomData = [
            'total' => $allRoomNumbers->count(),
            'available' => 0,
            'booked' => 0,
            'available_rooms' => [],
            'booked_rooms' => []
        ];
        
        foreach($allRoomNumbers as $room) {
            if(in_array($room->id, $bookedRoomIds)) {
                $roomData['booked']++;
                $roomData['booked_rooms'][] = $room;
            } else {
                $roomData['available']++;
                $roomData['available_rooms'][] = $room;
            }
        }

        return view('backend.book.index', compact(
            'allRoomNumbers', 
            'bookedRoomIds', 
            'checkIn', 
            'checkOut', 
            'roomTypes', 
            'selectedRoomType',
            'roomData' // ✅ সব ডাটা একসাথে
        ));
    }

    public function getRoomCount($id)
    {
        $count = RoomNo::where('room_id', $id)->count();
        return response()->json(['count' => $count]);
    }


    // The store method is removed because we moved it to BookingController
    // to keep logic clean (Search vs Storage).

   

    
}