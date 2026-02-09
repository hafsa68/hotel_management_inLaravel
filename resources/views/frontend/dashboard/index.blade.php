<!-- resources/views/frontend/dashboard/index.blade.php -->
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
    <div class="row">
        <div class="col-md-3">
            @include('frontend.dashboard.sidebar')
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Welcome, {{ Auth::user()->name }}!</h4>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-white bg-info">
                                <div class="card-body text-center">
                                    <h5>Total Bookings</h5>
                                    <h2>{{ $totalBookings }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success">
                                <div class="card-body text-center">
                                    <h5>Confirmed</h5>
                                    <h2>{{ $confirmedBookings }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body text-center">
                                    <h5>Upcoming</h5>
                                    <h2>{{ $upcomingBookings }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body text-center">
                                    <h5>Current Stay</h5>
                                    <h2>{{ $currentBookings }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Bookings -->
                    <h4 class="mb-3">Recent Bookings</h4>
                    
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Room</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->id }}</td>
                                        <td>
                                            @if($booking->room)
                                                {{ $booking->room->name }}
                                                @if($booking->roomNo)
                                                    <small class="text-muted">(Room {{ $booking->roomNo->room_no }})</small>
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ date('d M, Y', strtotime($booking->check_in)) }}</td>
                                        <td>{{ date('d M, Y', strtotime($booking->check_out)) }}</td>
                                        <td>
                                            @if($booking->status == 'confirmed')
                                                <span class="badge bg-success">Confirmed</span>
                                            @elseif($booking->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($booking->status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $booking->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $bookingDetailsRoute = '';
                                                try {
                                                    $bookingDetailsRoute = route('user.booking.details', $booking->id);
                                                } catch (\Exception $e) {
                                                    $bookingDetailsRoute = url('/booking/' . $booking->id);
                                                }
                                            @endphp
                                            
                                            <a href="{{ $bookingDetailsRoute }}" 
                                               class="btn btn-sm btn-info">
                                               View Details
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="mb-0">You haven't made any bookings yet.</p>
                            
                            @php
                                // Safe route for rooms
                                $roomsRoute = url('/');
                                try {
                                    $roomsRoute = route('rooms');
                                } catch (\Exception $e) {
                                    try {
                                        $roomsRoute = route('frontend.rooms');
                                    } catch (\Exception $e) {
                                        $roomsRoute = url('/rooms');
                                    }
                                }
                            @endphp
                            
                            <a href="{{ $roomsRoute }}" class="btn btn-primary mt-2">Book a Room</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection