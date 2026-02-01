@extends('frontend.layouts.master')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Available Rooms</h1>
    
    <!-- Search Summary -->
    <div class="card mb-4 bg-light">
        <div class="card-body">
            <h5>Search Summary:</h5>
            <p class="mb-1"><strong>Check-in:</strong> {{ $checkIn }}</p>
            <p class="mb-1"><strong>Check-out:</strong> {{ $checkOut }}</p>
            <p class="mb-1"><strong>Adults:</strong> {{ $adults }}</p>
            <p class="mb-0"><strong>Rooms:</strong> {{ $rooms }}</p>
        </div>
    </div>

    <!-- Available Rooms -->
    <h3 class="mb-3">Available Rooms ({{ count($availableRooms) }})</h3>
    
    @if(count($availableRooms) > 0)
    <div class="row">
        @foreach($availableRooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" class="card-img-top" alt="{{ $room->name }}">
                @else
                    <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        <span>No Image</span>
                    </div>
                @endif
                
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">
                        <strong>Capacity:</strong> {{ $room->capacity_adults }} Adults
                        @if($room->capacity_children)
                            + {{ $room->capacity_children }} Children
                        @endif
                    </p>
                    <p class="card-text">
                        <strong>Type:</strong> {{ $room->type }}
                    </p>
                    <p class="card-text">
                        <strong>Available Rooms:</strong> {{ $room->total_rooms }}
                    </p>
                    <p class="card-text">
                        <strong>Price:</strong> ${{ $room->price_per_night }} / Night
                    </p>
                    
                    <div class="mt-3">
                        <a href="{{ route('room.details', $room->id) }}" class="btn btn-info btn-sm">
                            View Details
                        </a>
                        <a href="{{ route('booking.create', ['room_id' => $room->id]) }}" class="btn btn-success btn-sm">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="text-center mt-4">
        <a href="{{ route('rooms') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to All Rooms
        </a>
    </div>
    
    @else
    <div class="alert alert-warning">
        <h4>No Rooms Available</h4>
        <p>Sorry, no rooms are available for your selected dates and criteria.</p>
        <a href="{{ route('rooms') }}" class="btn btn-primary">Try Different Dates</a>
    </div>
    @endif
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection