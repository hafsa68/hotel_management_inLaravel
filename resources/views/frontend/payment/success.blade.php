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
                    <!-- Success Icon -->
                    <div class="mb-4">
                        <div class="success-icon d-inline-flex align-items-center justify-content-center rounded-circle bg-success" 
                             style="width: 100px; height: 100px; font-size: 48px;">
                            <i class="fas fa-check text-white"></i>
                        </div>
                    </div>
                    
                    <!-- Success Message -->
                    <h2 class="text-success mb-3">Payment Successful!</h2>
                    <p class="lead mb-4">Thank you for your booking. Your payment has been processed successfully.</p>
                    
                    <!-- Booking Details -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Booking Details</h5>
                        </div>
                        <div class="card-body text-start">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Booking Reference:</strong></p>
                                    <p><strong>Room:</strong></p>
                                    <p><strong>Check-in Date:</strong></p>
                                    <p><strong>Check-out Date:</strong></p>
                                    <p><strong>Number of Nights:</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bold text-primary">{{ $booking->booking_reference }}</p>
                                    <p>{{ $booking->room->name }}</p>
                                    <p>{{ date('F d, Y', strtotime($booking->check_in)) }}</p>
                                    <p>{{ date('F d, Y', strtotime($booking->check_out)) }}</p>
                                    <p>{{ $booking->total_nights }} night(s)</p>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Total Amount:</strong></p>
                                    <p><strong>Payment Method:</strong></p>
                                    <p><strong>Payment Status:</strong></p>
                                    <p><strong>Booking Status:</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bold text-danger">${{ number_format($booking->total_amount, 2) }}</p>
                                    <p class="text-capitalize">{{ $booking->payment_method }}</p>
                                    <p><span class="badge bg-success">{{ $booking->payment_status }}</span></p>
                                    <p><span class="badge bg-info">{{ $booking->booking_status }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Guest Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Guest Information</h5>
                        </div>
                        <div class="card-body text-start">
                            <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $booking->customer_email }}</p>
                            <p><strong>Phone:</strong> {{ $booking->customer_phone }}</p>
                            @if($booking->customer_address)
                                <p><strong>Address:</strong> {{ $booking->customer_address }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Important Notes -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Important Information</h6>
                        <ul class="mb-0">
                            <li>Please keep your booking reference for check-in</li>
                            <li>Check-in time: 2:00 PM | Check-out time: 12:00 PM</li>
                            <li>Government-issued photo ID required at check-in</li>
                            <li>A confirmation email has been sent to {{ $booking->customer_email }}</li>
                        </ul>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-3 d-md-flex justify-content-center mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <a href="{{ route('user.bookings') }}" class="btn btn-outline-primary btn-lg px-4">
                            <i class="fas fa-list"></i> View My Bookings
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                    
                    <!-- Download Invoice -->
                    <div class="mt-4">
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-download"></i> Download Invoice (PDF)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .success-icon {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>
@endsection