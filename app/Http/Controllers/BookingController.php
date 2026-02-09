<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomNo;
use App\Models\User;
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
    $request->validate([
        'room_nos_id' => 'required|exists:room_nos,id',
        'guest_name'  => 'required|string|max:255',
        'guest_email' => 'required|email',
        'phone'       => 'required',
        'check_in'    => 'required|date',
        'check_out'   => 'required|date|after:check_in',
        'rooms_id'    => 'required|exists:rooms,id',
    ]);

    // 1️⃣ Calculate nights
    $nights = Carbon::parse($request->check_in)
        ->diffInDays(Carbon::parse($request->check_out));

    $room = Room::find($request->rooms_id);
    $totalPrice = $room->fare * $nights;

    // 2️⃣ Create booking FIRST
    $booking = Booking::create([
        'rooms_id'    => $request->rooms_id,
        'room_nos_id' => $request->room_nos_id,
        'guest_name'  => $request->guest_name,
        'guest_email' => $request->guest_email,
        'phone'       => $request->phone,
        'check_in'    => $request->check_in,
        'check_out'   => $request->check_out,
        'nights'      => $nights,
        'total_price'=> $totalPrice,
        'status'      => 'pending',
        'is_verified' => false,
    ]);

    // 3️⃣ Find or create user
    $user = User::firstOrCreate(
        ['email' => $request->guest_email],
        [
            'name'  => $request->guest_name,
            'phone' => $request->phone,
        ]
    );

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

    
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        
        return redirect()->route('booking.index')
            ->with('success', 'Booking deleted successfully!');
    }

    public function toggleStatus(Request $request)
{
    $booking = Booking::findOrFail($request->id);

    if ($booking->status == 'pending') {
        $booking->status = 'confirmed';
    } else {
        $booking->status = 'pending';
    }

    $booking->save();

    return response()->json([
        'success' => true,
        'badge_text' => ucfirst($booking->status),
        'badge_class' => $booking->status == 'confirmed'
            ? 'bg-success'
            : 'bg-warning text-dark',
        'next_action' => $booking->status == 'pending'
            ? 'Approve'
            : 'Pending',
    ]);
}


public function cancel(Request $request)
{
    $booking = Booking::findOrFail($request->id);
    $booking->status = 'cancelled';
    $booking->save();

    return response()->json(['success' => true]);
}
public function show($id)
{
    $booking = Booking::findOrFail($id);
    return view('frontend.dashboard.booking-details', compact('booking'));
}



}