<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\RoomNo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontendController extends Controller
{
     // হোমপেজ
    public function index()
    {
        // ✅ পরিবর্তন করুন: 'active' থেকে 'Enabled'
        $roomTypes = Room::where('status', 'Enabled')->take(3)->get();
        return view('frontend.pages.home', compact('roomTypes'));
    }

    // রুম লিস্টিং
    public function rooms()
    {
        // ✅ পরিবর্তন করুন: 'active' থেকে 'Enabled'
        $roomTypes = Room::where('status', 'Enabled')->get();
        
        // ডিবাগিং জন্য (সাময়িকভাবে)
        // dd($roomTypes); // ডেটা দেখুন
        
        return view('frontend.rooms', compact('roomTypes'));
    }

    // রুম ডিটেইলস
    public function roomDetails($id)
    {
        $room = Room::with('roomNos')->findOrFail($id);
        return view('frontend.room-details', compact('room'));
    }



    // এভেলিবিলিটি চেক (পাবলিক)
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $roomId = $request->room_id;

        // Booked রুমগুলো বের করুন
        $bookedRoomIds = Booking::where('rooms_id', $roomId)
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut])
                      ->orWhere(function($sub) use ($checkIn, $checkOut){
                          $sub->where('check_in', '<', $checkIn)
                              ->where('check_out', '>', $checkOut);
                      });
            })
            ->whereIn('status', ['booked', 'confirmed'])
            ->pluck('room_nos_id')
            ->toArray();

        // Available রুমগুলো
        $availableRooms = RoomNo::where('room_id', $roomId)
            ->whereNotIn('id', $bookedRoomIds)
            ->get();

        $room = Room::find($roomId);
        
        return view('frontend.check-availability', compact(
            'room', 
            'availableRooms', 
            'checkIn', 
            'checkOut'
        ));
    }

    // রুম বুকিং (লগইন রিকোয়ার্ড)
    public function bookRoom(Request $request)
    {
        // লগইন চেক
        if (!auth()->check()) {
            return redirect()->route('user.login')
                ->with('error', 'Please login to book a room.');
        }

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'room_no_id' => 'required|exists:room_nos,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // এভেলিবিলিটি ডাবল চেক
        $isAvailable = !Booking::where('room_nos_id', $request->room_no_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function($sub) use ($request) {
                          $sub->where('check_in', '<', $request->check_in)
                              ->where('check_out', '>', $request->check_out);
                      });
            })
            ->whereIn('status', ['booked', 'confirmed'])
            ->exists();

        if (!$isAvailable) {
            return redirect()->back()
                ->with('error', 'Sorry, this room is no longer available for the selected dates!')
                ->withInput();
        }

        // ক্যালকুলেশন
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        
        $room = Room::find($request->room_id);
        $totalPrice = $room->fare * $nights;

        // বুকিং তৈরি (user_id সহ)
        $booking = Booking::create([
            'rooms_id' => $request->room_id,
            'room_nos_id' => $request->room_no_id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'nights' => $nights,
            'total_price' => $totalPrice,
            'status' => 'booked',
            'source' => 'website',
            'user_id' => auth()->id(), // ✅ লগইন ইউজারের ID
        ]);

        return redirect()->route('frontend.booking.success', $booking->id);
    }

    // বুকিং সাকসেস
    public function bookingSuccess($id)
    {
        $booking = Booking::with(['room', 'roomNo'])->findOrFail($id);
        
        // Authorization check
        if ($booking->user_id != auth()->id()) {
            abort(403, 'Unauthorized access');
        }
        
        return view('frontend.booking-success', compact('booking'));
    }

    // কন্টাক্ট
    public function contact()
    {
        return view('frontend.contact');
    }

    // অ্যাবাউট
    public function about()
    {
        return view('frontend.about');
    }
}