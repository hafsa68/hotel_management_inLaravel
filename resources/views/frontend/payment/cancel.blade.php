@extends('frontend.layouts.master')


@section('header')
 <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Dahotel - Luxury Hotel HTML Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="{{url('')}}/assets/frontend/img/favicon.ico">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/animate.min.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/magnific-popup.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/fontawesome-pro/css/all.min.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/dripicons.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/slick.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/meanmenu.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/default.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/style.css">
        <link rel="stylesheet" href="{{url('')}}/assets/frontend/css/responsive.css">
    </head>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-body text-center p-5">
                    <!-- Cancel Icon -->
                    <div class="mb-4">
                        <div class="cancel-icon d-inline-flex align-items-center justify-content-center rounded-circle bg-warning" 
                             style="width: 100px; height: 100px; font-size: 48px;">
                            <i class="fas fa-ban text-white"></i>
                        </div>
                    </div>
                    
                    <!-- Cancel Message -->
                    <h2 class="text-warning mb-3">Payment Cancelled</h2>
                    <p class="lead mb-4">You have cancelled the payment process.</p>
                    
                    <!-- Information Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Booking Information</h5>
                        </div>
                        <div class="card-body text-start">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> 
                                <strong>Note:</strong> Your booking has been saved as "pending". You can complete the payment within 24 hours.
                            </div>
                            
                            <p><strong>Booking Status:</strong> <span class="badge bg-warning">Pending Payment</span></p>
                            <p><strong>Booking Reference:</strong> 
                                @if(session('booking_reference'))
                                    <span class="fw-bold">{{ session('booking_reference') }}</span>
                                @else
                                    <span class="text-muted">Not available</span>
                                @endif
                            </p>
                            <p class="mb-0"><strong>Reservation Hold:</strong> Your selected dates are temporarily reserved for 24 hours.</p>
                        </div>
                    </div>
                    
                    <!-- Why Cancel? -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Why did you cancel?</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <i class="fas fa-clock fa-2x text-secondary mb-2"></i>
                                        <p class="small mb-0">Need more time to decide</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <i class="fas fa-exchange-alt fa-2x text-secondary mb-2"></i>
                                        <p class="small mb-0">Change payment method</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <i class="fas fa-edit fa-2x text-secondary mb-2"></i>
                                        <p class="small mb-0">Need to modify booking</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <i class="fas fa-question-circle fa-2x text-secondary mb-2"></i>
                                        <p class="small mb-0">Have questions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Options -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">What would you like to do?</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-primary">
                                        <div class="card-body text-center">
                                            <i class="fas fa-credit-card fa-3x text-primary mb-3"></i>
                                            <h5>Complete Payment Now</h5>
                                            <p class="text-muted">Finish your booking with secure payment</p>
                                            @if(session('booking_id'))
                                                <a href="{{ route('payment.retry', session('booking_id')) }}" 
                                                   class="btn btn-primary">
                                                    <i class="fas fa-lock"></i> Secure Payment
                                                </a>
                                            @else
                                                <a href="{{ URL::previous() }}" class="btn btn-primary">
                                                    <i class="fas fa-redo"></i> Try Again
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-success">
                                        <div class="card-body text-center">
                                            <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                                            <h5>Pay Later</h5>
                                            <p class="text-muted">Complete payment within 24 hours</p>
                                            <p class="small text-danger mb-3">
                                                <i class="fas fa-clock"></i> 
                                                Booking expires in: <span id="countdown">24:00:00</span>
                                            </p>
                                            <a href="{{ route('user.bookings') }}" class="btn btn-success">
                                                <i class="fas fa-save"></i> Save for Later
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-3 d-md-flex justify-content-center mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-home"></i> Return Home
                        </a>
                        <a href="{{ route('frontend.rooms') }}" class="btn btn-outline-primary btn-lg px-4">
                            <i class="fas fa-search"></i> Browse Other Rooms
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-headset"></i> Contact Support
                        </a>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="text-muted">For any questions or assistance:</h6>
                        <div class="row justify-content-center mt-3">
                            <div class="col-auto">
                                <span class="badge bg-light text-dark p-2">
                                    <i class="fas fa-phone text-primary me-1"></i> +880 1234-567890
                                </span>
                            </div>
                            <div class="col-auto">
                                <span class="badge bg-light text-dark p-2">
                                    <i class="fas fa-envelope text-primary me-1"></i> booking@hotel.com
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Countdown Timer
function startCountdown() {
    let time = 24 * 60 * 60; // 24 hours in seconds
    const countdownElement = document.getElementById('countdown');
    
    const timer = setInterval(function() {
        const hours = Math.floor(time / 3600);
        const minutes = Math.floor((time % 3600) / 60);
        const seconds = time % 60;
        
        countdownElement.textContent = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (time <= 0) {
            clearInterval(timer);
            countdownElement.textContent = "EXPIRED";
            countdownElement.classList.add('text-danger', 'fw-bold');
        }
        
        time--;
    }, 1000);
}

// Start countdown when page loads
document.addEventListener('DOMContentLoaded', startCountdown);
</script>

<style>
.cancel-icon {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-10deg); }
    75% { transform: rotate(10deg); }
}
</style>
@endsection