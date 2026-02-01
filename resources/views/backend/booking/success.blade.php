<!-- resources/views/backend/booking/success.blade.php -->
@extends('backend.layouts.app')

@section("head")

<head>
    <meta charset="utf-8" />
    <title>All Booking Request | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{url('')}}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{url('')}}/assets/js/config.js"></script>

</head>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fa fa-check-circle mr-2"></i> Booking Confirmed</h4>
                    <span class="badge badge-light">Booking ID: {{ $booking->id }}</span>
                </div>
                
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fa fa-check-circle fa-5x text-success mb-3"></i>
                        <h2 class="text-success">Thank You!</h2>
                        <p class="lead">Your booking has been confirmed successfully.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fa fa-user"></i> Guest Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{ $booking->guest_name }}</p>
                                    <p><strong>Email:</strong> {{ $booking->guest_email ?? 'Not provided' }}</p>
                                    <p><strong>Phone:</strong> {{ $booking->phone ?? 'Not provided' }}</p>
                                    <p><strong>Booking Date:</strong> {{ $booking->created_at->format('d M, Y h:i A') }}</p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge badge-{{ $booking->status == 'booked' ? 'success' : 'warning' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fa fa-bed"></i> Room Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Room Type:</strong> {{ $booking->roomType->name ?? 'N/A' }}</p>
                                    <p><strong>Room Number:</strong> {{ $booking->room->room_number ?? 'N/A' }}</p>
                                    <p><strong>Check-in:</strong> {{ date('d M, Y', strtotime($booking->check_in)) }}</p>
                                    <p><strong>Check-out:</strong> {{ date('d M, Y', strtotime($booking->check_out)) }}</p>
                                    <p><strong>Nights:</strong> {{ $booking->nights }}</p>
                                    <p><strong>Total Price:</strong> ৳{{ number_format($booking->total_price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href=# class="btn btn-primary btn-lg mr-2">
                            <i class="fa fa-plus-circle"></i> New Booking
                        </a>
                        <a href="{{ route('booking.index') }}" class="btn btn-outline-primary btn-lg mr-2">
                            <i class="fa fa-list"></i> All booking
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-success btn-lg">
                            <i class="fa fa-print"></i> Print Invoice
                        </button>
                    </div>
                </div>
                
                <div class="card-footer text-center text-muted">
                    <small>For any queries, please contact reception.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .card-header, .card-footer, .alert, .text-center .btn {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        body {
            background: white !important;
        }
    }
</style>
@endsection