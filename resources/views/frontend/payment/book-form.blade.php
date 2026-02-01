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
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Book Your Room</h4>
                </div>
                
                <div class="card-body">
                    <!-- Error Messages -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <!-- Room Info Summary -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($room->main_image)
                                <img src="{{ asset($room->main_image) }}" class="img-fluid rounded" alt="{{ $room->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=Room" class="img-fluid rounded" alt="Room Image">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $room->name }}</h5>
                            <p><strong>Type:</strong> {{ $room->room_type }}</p>
                            <p><strong>Capacity:</strong> {{ $room->total_adult }} Adults, {{ $room->total_child }} Children</p>
                            <p><strong>Size:</strong> {{ $room->size }}</p>
                            <h4 class="text-primary">
                                @if($room->offer_fare < $room->fare)
                                    <span class="text-decoration-line-through text-muted">${{ $room->fare }}</span>
                                    <span class="ms-2">${{ $room->offer_fare }} / Night</span>
                                @else
                                    ${{ $room->fare }} / Night
                                @endif
                            </h4>
                        </div>
                    </div>
                    
                    <!-- Booking Form -->
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="row">
                            <!-- Dates Section -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Dates & Guests</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="check_in" class="form-label">Check-in Date *</label>
                                            <input type="date" class="form-control @error('check_in') is-invalid @enderror" 
                                                   id="check_in" name="check_in" 
                                                   value="{{ old('check_in') }}" required min="{{ date('Y-m-d') }}">
                                            @error('check_in')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="check_out" class="form-label">Check-out Date *</label>
                                            <input type="date" class="form-control @error('check_out') is-invalid @enderror" 
                                                   id="check_out" name="check_out" 
                                                   value="{{ old('check_out') }}" required>
                                            @error('check_out')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="adults" class="form-label">Adults *</label>
                                                    <input type="number" class="form-control @error('adults') is-invalid @enderror" 
                                                           id="adults" name="adults" min="1" max="{{ $room->total_adult }}" 
                                                           value="{{ old('adults', 1) }}" required>
                                                    @error('adults')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="children" class="form-label">Children</label>
                                                    <input type="number" class="form-control @error('children') is-invalid @enderror" 
                                                           id="children" name="children" min="0" max="{{ $room->total_child }}" 
                                                           value="{{ old('children', 0) }}">
                                                    @error('children')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="rooms" class="form-label">Number of Rooms *</label>
                                            <input type="number" class="form-control @error('rooms') is-invalid @enderror" 
                                                   id="rooms" name="rooms" min="1" 
                                                   value="{{ old('rooms', 1) }}" required>
                                            @error('rooms')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Customer Info Section -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Guest Information</h6>
                                    </div>
                                    <div class="card-body">
                                        @auth
                                            <!-- লগইন থাকলে অটো পপুলেট -->
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i> Your profile information will be used for booking.
                                            </div>
                                            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                            <input type="hidden" name="phone" value="{{ auth()->user()->phone ?? '' }}">
                                        @else
                                            <!-- লগইন না থাকলে ম্যানুয়ালি ইনপুট -->
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Full Name *</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name') }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address *</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number *</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endauth
                                        
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                                      id="address" name="address" rows="2">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="special_requests" class="form-label">Special Requests</label>
                                            <textarea class="form-control @error('special_requests') is-invalid @enderror" 
                                                      id="special_requests" name="special_requests" rows="3" 
                                                      placeholder="Any special requests or notes...">{{ old('special_requests') }}</textarea>
                                            @error('special_requests')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">Payment Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method *</label>
                                            <div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" 
                                                           type="radio" name="payment_method" id="sslcommerz" 
                                                           value="sslcommerz" {{ old('payment_method') == 'sslcommerz' ? 'checked' : 'checked' }}>
                                                    <label class="form-check-label" for="sslcommerz">
                                                        <i class="fas fa-credit-card"></i> SSL Commerz (Online Payment)
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" 
                                                           type="radio" name="payment_method" id="cod" 
                                                           value="cod" {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cod">
                                                        <i class="fas fa-money-bill-wave"></i> Cash on Arrival
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input @error('payment_method') is-invalid @enderror" 
                                                           type="radio" name="payment_method" id="bank" 
                                                           value="bank" {{ old('payment_method') == 'bank' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="bank">
                                                        <i class="fas fa-university"></i> Bank Transfer
                                                    </label>
                                                </div>
                                                @error('payment_method')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Price Summary</label>
                                            <div class="bg-light p-3 rounded">
                                                <div class="d-flex justify-content-between">
                                                    <span>Room Price (x <span id="nights">0</span> nights):</span>
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
                                                    <span>Total Amount:</span>
                                                    <span id="totalAmount">$0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms & Submit -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input @error('terms') is-invalid @enderror" 
                                       type="checkbox" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#cancellationModal">Cancellation Policy</a> *
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-lock"></i> Proceed to Payment
                            </button>
                            <a href="{{ route('frontend.rooms') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Rooms
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms & Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms & Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>1. Check-in time is 2:00 PM, check-out time is 12:00 PM.</p>
                <p>2. Early check-in and late check-out are subject to availability.</p>
                <p>3. Government-issued photo ID is required at check-in.</p>
                <p>4. Smoking is not allowed in rooms.</p>
                <p>5. Pets are not allowed.</p>
                <p>6. The hotel reserves the right to charge for any damages.</p>
                <p>7. All prices are inclusive of applicable taxes.</p>
            </div>
        </div>
    </div>
</div>

<!-- Cancellation Policy Modal -->
<div class="modal fade" id="cancellationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancellation Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>1. Free cancellation up to 48 hours before check-in.</p>
                <p>2. 50% refund for cancellations made 24-48 hours before check-in.</p>
                <p>3. No refund for cancellations made less than 24 hours before check-in.</p>
                <p>4. No-show will be charged 100% of the booking amount.</p>
                <p>5. Refunds will be processed within 7-10 business days.</p>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const roomsInput = document.getElementById('rooms');
    const roomPrice = {{ $room->offer_fare < $room->fare ? $room->offer_fare : $room->fare }};
    
    // Set tomorrow as default check-out
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowStr = tomorrow.toISOString().split('T')[0];
    
    // Set today as default check-in
    const today = new Date().toISOString().split('T')[0];
    checkInInput.min = today;
    checkInInput.value = today;
    
    // Set tomorrow as default check-out
    checkOutInput.min = tomorrowStr;
    checkOutInput.value = tomorrowStr;
    
    function calculateTotal() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        const rooms = parseInt(roomsInput.value) || 1;
        
        if (checkIn && checkOut && checkOut > checkIn) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            document.getElementById('nights').textContent = nights;
            
            const roomTotal = roomPrice * nights * rooms;
            const serviceCharge = 10.00;
            const vat = roomTotal * 0.15;
            const totalAmount = roomTotal + serviceCharge + vat;
            
            document.getElementById('roomTotal').textContent = '$' + roomTotal.toFixed(2);
            document.getElementById('vat').textContent = '$' + vat.toFixed(2);
            document.getElementById('totalAmount').textContent = '$' + totalAmount.toFixed(2);
        } else {
            document.getElementById('nights').textContent = '0';
            document.getElementById('roomTotal').textContent = '$0.00';
            document.getElementById('vat').textContent = '$0.00';
            document.getElementById('totalAmount').textContent = '$0.00';
        }
    }
    
    // Event listeners
    checkInInput.addEventListener('change', function() {
        // Set check-out min date to check-in + 1 day
        const nextDay = new Date(this.value);
        nextDay.setDate(nextDay.getDate() + 1);
        const nextDayStr = nextDay.toISOString().split('T')[0];
        
        checkOutInput.min = nextDayStr;
        if (checkOutInput.value < nextDayStr) {
            checkOutInput.value = nextDayStr;
        }
        calculateTotal();
    });
    
    checkOutInput.addEventListener('change', calculateTotal);
    roomsInput.addEventListener('input', calculateTotal);
    
    // Auto-populate for logged in users
    @auth
    if (!document.getElementById('name').value) {
        document.getElementById('name').value = '{{ auth()->user()->name }}';
    }
    if (!document.getElementById('email').value) {
        document.getElementById('email').value = '{{ auth()->user()->email }}';
    }
    if (!document.getElementById('phone').value && '{{ auth()->user()->phone ?? "" }}') {
        document.getElementById('phone').value = '{{ auth()->user()->phone }}';
    }
    @endauth
    
    // Initial calculation
    calculateTotal();
});
</script>
@endsection