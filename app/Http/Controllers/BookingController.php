<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomNo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display all booking
     */
    public function index()
{
    $query = Booking::with(['roomNo', 'room']); // ✅ সঠিক রিলেশন নাম
    
    // Search
    if (request()->has('search') && request('search') != '') {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('guest_name', 'like', '%' . $search . '%')
              ->orWhere('guest_email', 'like', '%' . $search . '%')
              ->orWhere('phone', 'like', '%' . $search . '%')
              ->orWhere('id', 'like', '%' . $search . '%');
        });
    }
    
    // Filter by status
    if (request()->has('status') && request('status') != '') {
        $query->where('status', request('status'));
    }
    
    // Filter by date (check_in date দিয়ে ফিল্টার করা ভালো)
    if (request()->has('date_from') && request('date_from') != '') {
        $query->whereDate('check_in', '>=', request('date_from'));
    }
    
    if (request()->has('date_to') && request('date_to') != '') {
        $query->whereDate('check_in', '<=', request('date_to'));
    }
    
    // Order by latest
    $booking = $query->orderBy('created_at', 'desc')->paginate(20);
    
    // ✅ Debug জন্য temporarily সব ডেটা দেখানো
   
    
    return view('backend.booking.index', compact('booking'));
}
    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'room_nos_id' => 'required|exists:room_nos,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'nullable|email|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'rooms_id' => 'required|exists:rooms,id',
        ]);

        // Calculate nights
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);

        // Get room fare
        $room = Room::find($request->rooms_id);
        $totalPrice = $room ? $room->fare * $nights : 0;

        // Check availability
        $isBooked = Booking::where('room_nos_id', $request->room_nos_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function($q) use ($request) {
                          $q->where('check_in', '<', $request->check_in)
                            ->where('check_out', '>', $request->check_out);
                      });
            })
            ->whereIn('status', ['booked', 'confirmed', 'pending'])
            ->exists();

        if ($isBooked) {
            return redirect()->back()
                ->with('error', 'This room is already booked for the selected dates!')
                ->withInput();
        }

        // Create booking
        $booking = Booking::create([
            'rooms_id' => $request->rooms_id,
            'room_nos_id' => $request->room_nos_id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'nights' => $nights,
            'total_price' => $totalPrice,
            'status' => 'booked',
        ]);

        // Success page এ Redirect
        return redirect()->route('booking.success', $booking->id)
            ->with('success', 'Booking successful! Booking ID: ' . $booking->id);
    }

    /**
     * Show success page after booking
     */
    public function success($id)
    {
        $booking = Booking::with(['room', 'roomType'])->findOrFail($id);
        return view('backend.booking.success', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking
     */
    public function edit($id)
    {
        $booking = Booking::with(['room', 'roomType'])->findOrFail($id);
        return view('backend.booking.edit', compact('booking'));
    }

    /**
     * Update the specified booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'status' => 'required|in:booked,confirmed,pending,cancelled,completed',
        ]);
        
        // Recalculate if dates changed
        if ($booking->check_in != $request->check_in || $booking->check_out != $request->check_out) {
            $checkIn = Carbon::parse($request->check_in);
            $checkOut = Carbon::parse($request->check_out);
            $nights = $checkIn->diffInDays($checkOut);
            
            $room = Room::find($booking->rooms_id);
            $totalPrice = $room ? $room->fare * $nights : 0;
            
            $booking->nights = $nights;
            $booking->total_price = $totalPrice;
        }
        
        $booking->update([
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => $request->status,
        ]);
        
        return redirect()->route('booking.index')
            ->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified booking
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        
        return redirect()->route('booking.index')
            ->with('success', 'Booking deleted successfully!');
    }
}