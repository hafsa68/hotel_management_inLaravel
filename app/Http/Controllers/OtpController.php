<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    public function verify(Request $request)
    {
        try {
            // ১. ডিবাগ লগ
            Log::info('OTP Verification Request:', $request->all());
            
            // ২. Validation
            $validated = $request->validate([
                'booking_id' => 'required|integer|exists:bookings,id',
                'otp' => 'required|digits:6|string'
            ]);
            
            Log::info('Validation passed');
            
            // ৩. বুকিং খুঁজুন
            $booking = Booking::find($validated['booking_id']);
            
            if (!$booking) {
                Log::error('Booking not found:', ['id' => $validated['booking_id']]);
                return back()->withErrors(['otp' => 'Booking not found.']);
            }
            
            Log::info('Booking found:', ['booking_id' => $booking->id, 'email' => $booking->guest_email]);
            
            // ৪. ইউজার খুঁজুন
            $user = User::where('email', $booking->guest_email)->first();
            
            if (!$user) {
                Log::error('User not found for email:', ['email' => $booking->guest_email]);
                return back()->withErrors(['otp' => 'User not found. Please contact support.']);
            }
            
            Log::info('User found:', ['user_id' => $user->id, 'otp_stored' => $user->otp]);
            
            // ৫. OTP চেক করুন
            $currentOtp = $user->otp;
            $enteredOtp = $validated['otp'];
            
            if (empty($currentOtp)) {
                Log::error('No OTP stored for user');
                return back()->withErrors(['otp' => 'OTP expired or already used.']);
            }
            
            if ($user->otp_expires_at && now()->greaterThan($user->otp_expires_at)) {
                Log::error('OTP expired:', ['expires_at' => $user->otp_expires_at]);
                return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
            }
            
            if ($currentOtp != $enteredOtp) {
                Log::error('OTP mismatch:', ['stored' => $currentOtp, 'entered' => $enteredOtp]);
                return back()->withErrors(['otp' => 'Invalid OTP.']);
            }
            
            // ৬. OTP সঠিক - প্রসেস সম্পূর্ণ করুন
            Log::info('OTP verification successful');
            
            // User আপডেট
            $user->update([
                'otp' => null,
                'otp_expires_at' => null,
                'email_verified_at' => now(),
                'last_login_at' => now(),
            ]);
            
            // Booking আপডেট
            $booking->update([
                'is_verified' => true,
                'status' => 'confirmed',
                'user_id' => $user->id,
            ]);
            
            // অটো লগইন
            Auth::login($user);
            Log::info('User logged in:', ['user_id' => $user->id]);
            
            // ৭. সাকসেস রেসপন্স
            // যদি dashboard রাউট না থাকে
            return redirect('/')
                ->with('success', 'Booking confirmed successfully! Welcome to your dashboard.');
                
        } catch (\Exception $e) {
            Log::error('OTP Verification Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['otp' => 'Something went wrong. Please try again.']);
        }
    }
    
    public function form(Booking $booking)
    {
        Log::info('OTP form accessed:', ['booking_id' => $booking->id]);
        return view('frontend.booking.verify-otp', compact('booking'));
    }
    
    public function resend($id)
    {
        try {
            Log::info('Resend OTP request:', ['booking_id' => $id]);
            
            $booking = Booking::findOrFail($id);
            $user = User::where('email', $booking->guest_email)->first();
            
            if (!$user) {
                Log::error('User not found for resend');
                return back()->with('error', 'User not found.');
            }
            
            // নতুন OTP জেনারেট করুন
            $otp = rand(100000, 999999);
            
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(5),
            ]);
            
            Log::info('New OTP generated:', ['otp' => $otp, 'user_id' => $user->id]);
            
            // ইমেইল পাঠান
            Mail::to($user->email)->send(new SendOtpMail($otp));
            Log::info('OTP email sent to:', ['email' => $user->email]);
            
            return back()->with('success', 'New OTP sent to your email.');
            
        } catch (\Exception $e) {
            Log::error('Resend OTP Error:', [
                'message' => $e->getMessage(),
                'booking_id' => $id
            ]);
            
            return back()->with('error', 'Failed to resend OTP. Please try again.');
        }
    }
}