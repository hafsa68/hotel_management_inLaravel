<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\RoomNo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // বুকিং ফর্ম দেখানোর জন্য
    public function bookForm(Request $request)
    {
        $roomId = $request->room_id;
        $room = Room::findOrFail($roomId);
        return view('frontend.payment.book', compact('room'));
    }

    // Offline / Direct Booking Process
    public function processBooking(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'rooms' => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($request->room_id);
        $roomPrice = ($room->offer_fare && $room->offer_fare < $room->fare) ? $room->offer_fare : $room->fare;

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);

        $totalPrice = $roomPrice * $nights * $request->rooms;
        $serviceCharge = 10;
        $vat = $totalPrice * 0.15;
        $grandTotal = $totalPrice + $vat + $serviceCharge;

        // Booking create, status pending
        $booking = Booking::create([
            'rooms_id' => $room->id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'nights' => $nights,
            'rooms' => $request->rooms,
            'total_price' => $grandTotal,
            'status' => 'pending', // offline so pending
            'source' => 'website',
            'user_id' => auth()->id(),
        ]);

        // Redirect to offline success page
        return redirect()->route('payment.offline.success', $booking->id)
                         ->with('success', 'Booking created successfully! Please complete payment offline.');
    }

    // Offline Success Page
    public function offlineSuccess($id)
    {
        $booking = Booking::with('room')->findOrFail($id);
        return view('frontend.payment.success', compact('booking'));
    }

    // Bank Transfer page
    public function bankTransfer($id)
    {
        $booking = Booking::findOrFail($id);
        return view('frontend.payment.bank', compact('booking'));
    }

    // Upload Bank Receipt
    public function uploadReceipt(Request $request, $id)
    {
        $request->validate([
            'receipt' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/receipts'), $filename);
            $booking->receipt = $filename;
            $booking->status = 'booked'; // Mark as booked after receipt upload
            $booking->save();
        }

        return redirect()->route('payment.success', $booking->id)
                         ->with('success', 'Receipt uploaded successfully!');
    }

    // Retry Payment page
    public function retryPayment($id)
    {
        $booking = Booking::findOrFail($id);
        return view('frontend.payment.retry', compact('booking'));
    }

    // Booking Success Page
    public function success($id)
    {
        $booking = Booking::with(['room', 'roomNo'])->findOrFail($id);
        return view('frontend.payment.success', compact('booking'));
    }

    // Booking Failed Page
    public function fail()
    {
        return view('frontend.payment.fail');
    }

    // Booking Cancelled Page
    public function cancel()
    {
        return view('frontend.payment.cancel');
    }

    public function invoice($id)
{
    $booking = Booking::with('room', 'roomNo')->findOrFail($id);

    return view('frontend.payment.invoice', compact('booking'));
}

}
