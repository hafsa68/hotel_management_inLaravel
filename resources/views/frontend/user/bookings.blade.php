@extends('backend.layouts.app')

@section('head')

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/config.js"></script>
</head>
@endsection

@section('content')
<div class="container py-5">
    <h2>My Bookings</h2>
    @if($bookings->count() > 0)
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Room</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->room->name }}</td>
                <td>{{ $booking->check_in->format('F d, Y') }}</td>
                <td>{{ $booking->check_out->format('F d, Y') }}</td>
                <td>${{ number_format($booking->total_price, 2) }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>

                    <a href="{{ route('user.booking.details', $booking->id) }}" class="btn btn-sm btn-primary">View</a>

                    @if($booking->status != 'cancelled')
                    <a href="{{ route('user.booking.cancel', $booking->id) }}" class="btn btn-sm btn-danger">Cancel</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bookings->links() }}
    @else
    <div class="alert alert-info mt-4">
        You have no bookings yet.
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Knob charts js -->
<script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Sparkline Js-->
<script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<!-- Dashboard init-->
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection