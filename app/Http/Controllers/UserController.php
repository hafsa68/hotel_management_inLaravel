<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Registration Form
    public function showRegister()
    {
        return view('frontend.auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'active'
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard')
            ->with('success', 'Registration successful! Welcome to our platform.');
    }

    // Login Form
    public function showLogin()
    {
        return view('frontend.auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.dashboard')
                ->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }

    // User Dashboard
    public function dashboard()
    {
        $user = auth()->user();
        $recentBookings = Booking::where('guest_email', $user->email)
            ->with(['room', 'roomNo'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('frontend.user.dashboard', compact('user', 'recentBookings'));
    }

    // User's Bookings
    public function myBookings()
    {
        $bookings = Booking::where('guest_email', auth()->user()->email)
            ->with(['room', 'roomNo'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('frontend.user.bookings', compact('bookings'));
    }

    // Booking Details
    public function bookingDetails($id)
    {
        $booking = Booking::with(['room', 'roomNo'])->findOrFail($id);
        
        // Check authorization
        if ($booking->guest_email != auth()->user()->email) {
            abort(403, 'Unauthorized access');
        }
        
        return view('frontend.user.booking-details', compact('booking'));
    }

    // Cancel Booking
    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->guest_email != auth()->user()->email) {
            abort(403, 'Unauthorized access');
        }
        
        if ($booking->status == 'cancelled') {
            return back()->with('error', 'Booking is already cancelled.');
        }
        
        $booking->update(['status' => 'cancelled']);
        
        return back()->with('success', 'Booking cancelled successfully.');
    }

    // Profile
    public function profile()
    {
        return view('frontend.user.profile', ['user' => auth()->user()]);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);
        
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        return back()->with('success', 'Profile updated successfully.');
    }
}