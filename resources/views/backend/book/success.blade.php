@extends('backend.layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    <h2 class="font-weight-bold">Booking Confirmed!</h2>
                    <p class="text-muted">Your reservation has been successfully processed.</p>
                    
                    <div class="bg-light p-4 rounded text-left mt-4">
                        <h5 class="border-bottom pb-2 mb-3">Booking Details</h5>
                        <p><strong>Booking ID:</strong> #BK-{{ $booking->id }}</p>
                        <p><strong>Guest Name:</strong> {{ $booking->guest_name }}</p>
                        <p><strong>Room Type:</strong> {{ $booking->roomType->name ?? 'N/A' }}</p>
                        <p><strong>Room Number:</strong> <span class="badge badge-primary">{{ $booking->roomNo->room_number ?? 'N/A' }}</span></p>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted d-block">CHECK-IN</small>
                                <strong>{{ date('d M, Y', strtotime($booking->check_in)) }}</strong>
                            </div>
                            <div class="col-6 text-right">
                                <small class="text-muted d-block">CHECK-OUT</small>
                                <strong>{{ date('d M, Y', strtotime($booking->check_out)) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 no-print">
                        <a href="{{ route('book.index') }}" class="btn btn-primary">Book Another Room</a>
                        <button onclick="window.print()" class="btn btn-outline-secondary">
                            <i class="fa fa-print"></i> Print Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print { display: none; }
        .card { border: none !important; shadow: none !important; }
    }
</style>
@endsection