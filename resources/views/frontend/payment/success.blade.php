@extends('frontend.layouts.master')

@section('header')
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Booking Success - Dahotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/frontend/img/favicon.ico') }}">
    
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ url('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/fontawesome/css/all.min.css') }}">
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
                    <h2 class="text-success mb-3">Booking Successful!</h2>
                    <p class="lead mb-4">Thank you for your booking. Your payment has been received.</p>
                    
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
                                    <p class="fw-bold text-primary">{{ $booking->id }}</p>
                                    <p>{{ $booking->room->name }}</p>
                                    <p>{{ date('F d, Y', strtotime($booking->check_in)) }}</p>
                                    <p>{{ date('F d, Y', strtotime($booking->check_out)) }}</p>
                                    <p>{{ $booking->nights }} night(s)</p>
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
                                    <p class="fw-bold text-danger">${{ number_format($booking->total_price, 2) }}</p>
                                    <p class="text-capitalize">Offline / Bank Transfer</p>
                                    <p><span class="badge bg-success">{{ ucfirst($booking->status) }}</span></p>
                                    <p><span class="badge bg-info">{{ ucfirst($booking->status) }}</span></p>
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
                            <p><strong>Name:</strong> {{ $booking->guest_name }}</p>
                            <p><strong>Email:</strong> {{ $booking->guest_email }}</p>
                            <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                            @if($booking->address)
                                <p><strong>Address:</strong> {{ $booking->address }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Important Notes -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Important Information</h6>
                        <ul class="mb-0">
                            <li>Keep your booking reference for check-in</li>
                            <li>Check-in time: 2:00 PM | Check-out time: 12:00 PM</li>
                            <li>Government-issued photo ID required at check-in</li>
                            <li>A confirmation email has been sent to {{ $booking->guest_email }}</li>
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
                        <a href="{{ route('payment.invoice', $booking->id ?? 0) }}" class="btn btn-success">
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
