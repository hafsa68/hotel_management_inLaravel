@extends('backend.layouts.app')

@section('head')

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon"  href="{{url('')}}/assets/images/favicon.ico">

    <link  href="{{url('')}}/assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link  href="{{url('')}}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link  href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{url('')}}/assets/js/config.js"></script>
</head>
@endsection


@section('content')
<div class="container py-5">
    <div class="row">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Booking Details #{{ $booking->id }}</h4>
                    <a  href="{{ route('user.bookings') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Booking Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Booking ID</th>
                                    <td>#{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <th>Booking Date</th>
                                    <td>{{ $booking->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($booking->status == 'confirmed')
                                            <span class="badge bg-success">Confirmed</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Verified</th>
                                    <td>
                                        @if($booking->is_verified)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-warning">No</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Guest Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Guest Name</th>
                                    <td>{{ $booking->guest_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $booking->guest_email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $booking->phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Room Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Room Type</th>
                                    <td>
                                        @if($booking->room)
                                            {{ $booking->room->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Room Number</th>
                                    <td>
                                        @if($booking->roomNo)
                                            {{ $booking->roomNo->room_no }}
                                        @else
                                            Not Assigned Yet
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Check-in</th>
                                    <td>{{ date('d M, Y', strtotime($booking->check_in)) }}</td>
                                </tr>
                                <tr>
                                    <th>Check-out</th>
                                    <td>{{ date('d M, Y', strtotime($booking->check_out)) }}</td>
                                </tr>
                                <tr>
                                    <th>Nights</th>
                                    <td>{{ $booking->nights }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Payment Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Total Price</th>
                                    <td>${{ number_format($booking->total_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Price per Night</th>
                                    <td>
                                        @if($booking->room)
                                            ${{ number_format($booking->room->fare, 2) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td class="fw-bold">${{ number_format($booking->total_price, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($booking->status == 'pending')
                        <div class="mt-4">
                            <form action="{{ route('user.booking.cancel', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    <i class="fas fa-times"></i> Cancel Booking
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{url('')}}/{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{url('')}}/{{ asset('assets/js/app.js') }}"></script>

<!-- Knob charts js -->
<script src="{{url('')}}/{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Sparkline Js-->
<script src="{{url('')}}/{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{url('')}}/{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{url('')}}/{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<!-- Dashboard init-->
<script src="{{url('')}}/{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection