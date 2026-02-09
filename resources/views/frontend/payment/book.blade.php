@extends('frontend.layouts.master')

@section('header')
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dahotel - Luxury Hotel Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ url('') }}/assets/frontend/img/favicon.ico">
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/style.css">
</head>
@endsection

@section('content')
@php
    $roomPrice = ($room->offer_fare && $room->offer_fare < $room->fare) ? $room->offer_fare : $room->fare;
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Book Your Room</h4>
                </div>
                <div class="card-body">

                    <!-- Room Info -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($room->main_image)
                            <img src="{{ asset($room->main_image) }}" class="img-fluid rounded" alt="{{ $room->name }}">
                            @else
                            <img src="https://via.placeholder.com/300x200?text=Room" class="img-fluid rounded" alt="Room Image">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h5 class="text-primary">{{ $room->name }}</h5>
                            <p><i class="fas fa-bed"></i> <strong>Type:</strong> {{ $room->room_type ?? 'Standard' }}</p>
                            <p><i class="fas fa-user-friends"></i> <strong>Capacity:</strong> {{ $room->total_adult }} Adults @if($room->total_child > 0)+ {{ $room->total_child }} Children @endif</p>
                            <p><i class="fas fa-ruler-combined"></i> <strong>Size:</strong> {{ $room->size ?? 'N/A' }}</p>
                            <h4 class="text-primary">
                                @if($room->offer_fare && $room->offer_fare < $room->fare)
                                    <span class="text-decoration-line-through text-muted">${{ $room->fare }}</span>
                                    <span class="ms-2">${{ $room->offer_fare }} / Night</span>
                                @else
                                    ${{ $room->fare }} / Night
                                @endif
                            </h4>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <form action="{{ route('payment.process') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div class="row">
                            <!-- Dates & Guests -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="check_in" class="form-label">Check-in Date *</label>
                                    <input type="date" id="check_in" name="check_in" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="check_out" class="form-label">Check-out Date *</label>
                                    <input type="date" id="check_out" name="check_out" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="adults" class="form-label">Adults *</label>
                                    <input type="number" id="adults" name="adults" class="form-control" min="1" max="{{ $room->total_adult }}" value="1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="children" class="form-label">Children</label>
                                    <input type="number" id="children" name="children" class="form-control" min="0" max="{{ $room->total_child }}" value="0">
                                </div>
                                <div class="mb-3">
                                    <label for="rooms" class="form-label">Rooms *</label>
                                    <input type="number" id="rooms" name="rooms" class="form-control" min="1" value="1" required>
                                </div>
                            </div>

                            <!-- Guest Info -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" id="name" name="guest_name" class="form-control" value="{{ auth()->user()->name ?? old('name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" id="email" name="guest_email" class="form-control" value="{{ auth()->user()->email ?? old('email') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone *</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ auth()->user()->phone ?? old('phone') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="special_requests" class="form-label">Special Requests</label>
                                    <textarea id="special_requests" name="special_requests" class="form-control" rows="3">{{ old('special_requests') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="mb-3">
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <span>Room Price (<span id="nights">0</span> nights):</span>
                                    <span id="roomTotal">$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Service Charge:</span>
                                    <span id="serviceCharge">$10.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>VAT (15%):</span>
                                    <span id="vat">$0.00</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total:</span>
                                    <span id="totalAmount">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">Proceed to Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const roomsInput = document.getElementById('rooms');

    const nightsEl = document.getElementById('nights');
    const roomTotalEl = document.getElementById('roomTotal');
    const serviceEl = document.getElementById('serviceCharge');
    const vatEl = document.getElementById('vat');
    const totalEl = document.getElementById('totalAmount');

    const roomPrice = {{ $roomPrice }}; // Blade value
    const serviceCharge = 10;

   function calcTotal() {
    if(!checkIn.value || !checkOut.value) return;

    // Dates as midnight to avoid timezone issues
    const d1 = new Date(checkIn.value + 'T00:00:00');
    const d2 = new Date(checkOut.value + 'T00:00:00');
    const nRooms = parseInt(roomsInput.value) || 1;

    if(d2 <= d1) return;

    // Calculate difference in days
    const diffTime = d2.getTime() - d1.getTime();
    const nights = Math.round(diffTime / (1000 * 60 * 60 * 24)); // Pure full nights

    const roomTotal = roomPrice * nights * nRooms;
    const vat = roomTotal * 0.15;
    const total = roomTotal + vat + serviceCharge;

    nightsEl.textContent = nights;
    roomTotalEl.textContent = '$' + roomTotal.toFixed(2);
    vatEl.textContent = '$' + vat.toFixed(2);
    serviceEl.textContent = '$' + serviceCharge.toFixed(2);
    totalEl.textContent = '$' + total.toFixed(2);
}


    checkIn.addEventListener('change', function() {
        const nextDay = new Date(this.value);
        nextDay.setDate(nextDay.getDate() + 1);
        checkOut.min = nextDay.toISOString().split('T')[0];
        if(new Date(checkOut.value) <= nextDay) {
            checkOut.value = nextDay.toISOString().split('T')[0];
        }
        calcTotal();
    });

    checkOut.addEventListener('change', calcTotal);
    roomsInput.addEventListener('input', calcTotal);

    // Default dates
    const today = new Date().toISOString().split('T')[0];
    checkIn.value = today;

    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    checkOut.value = tomorrow.toISOString().split('T')[0];
    checkOut.min = tomorrow.toISOString().split('T')[0];

    calcTotal();
});
</script>
@endsection
