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
    <h1 class="mb-4">Suites & Rooms</h1>

    <!-- Check Availability Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('frontend.check.availability') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label>Check In</label>
                    <input type="date" name="check_in" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Check Out</label>
                    <input type="date" name="check_out" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label>Adults</label>
                    <input type="number" name="adults" class="form-control" min="1" value="1">
                </div>
                <div class="col-md-2">
                    <label>Rooms</label>
                    <input type="number" name="rooms" class="form-control" min="1" value="1">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Check Availability</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Room Listing -->
    <div class="row">
        @forelse($roomTypes as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img
                    src="{{ asset($room->main_image) }}"
                    class="card-img-top"
                    style="height:200px; object-fit:cover;">



                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $room->name }}</h5>
                    <p class="card-text">
                        <i class="fas fa-user-friends"></i>
                        <strong>Capacity:</strong> {{ $room->total_adult ?? 2 }} Adults
                        @if(isset($room->total_child) && $room->total_child > 0)
                        + {{ $room->total_child }} Children
                        @endif

                    </p>
                    <p class="card-text">
                        <i class="fas fa-bed"></i>
                        <strong>Type:</strong> {{ $room->room_type ?? 'Standard' }}
                    </p>
                    <p class="card-text">
                        <i class="fas fa-box-open"></i>
                        <strong>Available Rooms:</strong>
                        {{ $room->roomNumbers->count() }}
                    </p>

                    </p>
                    <p class="card-text">
                        <i class="fas fa-tag"></i>
                        <strong>Price:</strong>
                        <span class="fw-bold text-danger">
                            ${{ $room->fare }} / Night
                        </span>
                    </p>


                    <div class="mt-1">
                        <a href="route('frontend.room.details', $room->id) " class="btn btn-outline-success btn-sm">
                            <i class="fas fa-info-circle"></i> View Details
                        </a> <br> <br>
                        <!-- Book Now বাটন আপডেট -->
                        <a href="{{ route('payment.book.form', ['room_id' => $room->id]) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-calendar-check"></i> Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> No rooms available at the moment.
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .card {
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .badge {
        font-size: 0.8em;
    }
</style>
@endsection