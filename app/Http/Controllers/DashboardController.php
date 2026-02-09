<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the dashboard page.
     */
    public function index()
    {
        // User must be logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Get user's bookings with room details
        $bookings = Booking::with(['room', 'roomNo'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get latest booking for sidebar
        $latestBooking = Booking::where('user_id', $user->id)->latest()->first();
        
        // Statistics
        $totalBookings = Booking::where('user_id', $user->id)->count();
        $confirmedBookings = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->count();
        
        $upcomingBookings = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('check_in', '>=', Carbon::today())
            ->count();
        
        $currentBookings = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('check_in', '<=', Carbon::today())
            ->where('check_out', '>=', Carbon::today())
            ->count();

        return view('frontend.dashboard.index', compact(
            'user',
            'bookings',
            'totalBookings',
            'confirmedBookings',
            'upcomingBookings',
            'currentBookings',
            'latestBooking'
        ));
    }

    /**
     * Show the user's bookings list.
     */
    public function bookings()
    {
        $bookings = Booking::with('room') // Room relation
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        $latestBooking = $bookings->first(); // সর্বশেষ Booking

        return view('frontend.dashboard.bookings', compact('bookings', 'latestBooking'));
    }

    public function bookingDetails($id)
    {
        $booking = Booking::with('room')->where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.dashboard.booking-details', compact('booking'));
    }
}
