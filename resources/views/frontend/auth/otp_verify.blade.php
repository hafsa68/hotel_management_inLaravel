@extends('frontend.layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Verify OTP</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        We've sent a 6-digit OTP to <strong>{{ $booking->guest_email }}</strong>
                    </div>
                    
                    <form action="{{ route('otp.verify') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" 
                                   class="form-control form-control-lg text-center @error('otp') is-invalid @enderror" 
                                   id="otp" 
                                   name="otp" 
                                   placeholder="000000" 
                                   maxlength="6"
                                   required>
                            @error('otp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-check-circle"></i> Verify & Confirm Booking
                        </button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <p class="text-muted mb-1">Didn't receive OTP?</p>
                        <form action="{{ route('otp.resend', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link">
                                <i class="fas fa-redo"></i> Resend OTP
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">OTP will expire in 5 minutes</small>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Auto focus on OTP input --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('otp').focus();
    });
</script>
@endsection