<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;    // Needed to get room fare
use App\Models\RoomNo;  // Needed for validation
use Illuminate\Http\Request;
use Carbon\Carbon;      // Needed for date calculations

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = Booking::latest()->get();
         return view('backend.booking.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the form data
        $request->validate([
            'rooms_id'    => 'required|exists:rooms,id',
            'room_nos_id' => 'required|exists:room_nos,id',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
            'guest_name'  => 'required|string|max:255',
            'guest_email' => 'nullable|email',
        ]);

        // 2. Double-Check Availability (Concurrency Check)
        // Prevent booking if someone else booked the same room milliseconds ago
        $isBooked = Booking::where('room_nos_id', $request->room_nos_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function($sub) use ($request){
                          $sub->where('check_in', '<=', $request->check_in)
                              ->where('check_out', '>=', $request->check_out);
                      });
            })->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'Sorry, this room was just booked by another user!');
        }

        // 3. Calculate Nights & Total Price
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        
        // Ensure at least 1 night is charged even if check-out is same day (depending on your policy)
        if ($nights == 0) $nights = 1; 

        $room = Room::findOrFail($request->rooms_id);
        $totalPrice = $nights * $room->fare;

        // 4. Create the Booking Record
        Booking::create([
            'rooms_id'    => $request->rooms_id,
            'room_nos_id' => $request->room_nos_id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guest_name'  => $request->guest_name,
            'guest_email' => $request->guest_email,
            'nights'      => $nights,
            'total_price' => $totalPrice,
            'status'      => 'booked',
        ]);

        // 5. Redirect
        return redirect()->route('book.index')->with('success', 'Room booked successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used (using Wizard instead)
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}