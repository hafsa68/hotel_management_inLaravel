@extends('backend.layouts.app')

@section('header')

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
    <script  src="{{url('')}}/assets/js/config.js"></script>

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
                    <h4 class="mb-0">My Bookings</h4>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Room Type</th>
                                    <th>Room No</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Nights</th>
                                    <th>Total Price</th>
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
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->roomNo)
                                        {{ $booking->roomNo->room_no }}
                                        @else
                                        Not Assigned
                                        @endif
                                    </td>
                                    <td>{{ date('d M, Y', strtotime($booking->check_in)) }}</td>
                                    <td>{{ date('d M, Y', strtotime($booking->check_out)) }}</td>
                                    <td>{{ $booking->nights }}</td>
                                    <td>${{ number_format($booking->total_price, 2) }}</td>
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
                                        @foreach($bookings as $booking)
                                        <a  href="{{url('')}}/{{ route('user.booking.details', $booking->id) }}"
                                            class="btn btn-sm btn-primary">
                                            View Details
                                        </a>
                                        @endforeach
                                        @if($booking->status == 'pending')
                                        <form action="{{ route('user.booking.cancel', $booking->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Cancel this booking?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        @endif
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
                        <a  href="{{url('')}}/#" class="btn btn-primary mt-2">Book a Room</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script  src="{{url('')}}/assets/js/vendor.min.js"></script>
<script  src="{{url('')}}/assets/js/app.js"></script>

<!-- Knob charts js -->
<script  src="{{url('')}}/assets/libs/jquery-knob/jquery.knob.min.js"></script>

<!-- Sparkline Js-->
<script  src="{{url('')}}/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<script  src="{{url('')}}/assets/libs/morris.js/morris.min.js"></script>

<script  src="{{url('')}}/assets/libs/raphael/raphael.min.js"></script>

<!-- Dashboard init-->
<script  src="{{url('')}}/assets/js/pages/dashboard.js"></script>
@endsection