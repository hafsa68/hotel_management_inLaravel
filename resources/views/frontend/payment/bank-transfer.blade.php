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
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-university"></i> Bank Transfer Payment</h4>
                </div>
                
                <div class="card-body">
                    <!-- Progress Steps -->
                    <div class="mb-5">
                        <div class="d-flex justify-content-between">
                            <div class="text-center">
                                <div class="step-circle bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                     style="width: 50px; height: 50px;">
                                    1
                                </div>
                                <div class="step-label">Booking</div>
                            </div>
                            <div class="text-center">
                                <div class="step-circle bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                     style="width: 50px; height: 50px;">
                                    2
                                </div>
                                <div class="step-label">Payment Method</div>
                            </div>
                            <div class="text-center">
                                <div class="step-circle bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                     style="width: 50px; height: 50px;">
                                    3
                                </div>
                                <div class="step-label">Bank Transfer</div>
                            </div>
                            <div class="text-center">
                                <div class="step-circle bg-light border rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                     style="width: 50px; height: 50px;">
                                    4
                                </div>
                                <div class="step-label">Confirmation</div>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 3px;">
                            <div class="progress-bar" style="width: 66%;"></div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Left Column: Booking Summary -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Booking Summary</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Booking Reference:</strong></td>
                                            <td class="text-end fw-bold text-primary">{{ $booking->booking_reference }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Room:</strong></td>
                                            <td class="text-end">{{ $booking->room->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Check-in:</strong></td>
                                            <td class="text-end">{{ date('d M, Y', strtotime($booking->check_in)) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Check-out:</strong></td>
                                            <td class="text-end">{{ date('d M, Y', strtotime($booking->check_out)) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nights:</strong></td>
                                            <td class="text-end">{{ $booking->total_nights }}</td>
                                        </tr>
                                        <tr class="border-top">
                                            <td><strong>Total Amount:</strong></td>
                                            <td class="text-end fw-bold text-danger">${{ number_format($booking->total_amount, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Payment Status</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-clock"></i> 
                                        <strong>Pending Payment</strong>
                                        <p class="mb-0 mt-2">Please complete bank transfer within 24 hours to confirm your booking.</p>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button class="btn btn-outline-primary" onclick="window.print()">
                                            <i class="fas fa-print"></i> Print This Page
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column: Bank Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Bank Account Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="bank-info">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bank-logo me-3">
                                                <i class="fas fa-university fa-3x text-primary"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-0">{{ $bankInfo['bank_name'] }}</h4>
                                                <p class="text-muted mb-0">Main Branch</p>
                                            </div>
                                        </div>
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="bg-light">Account Name</th>
                                                    <td>{{ $bankInfo['account_name'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Account Number</th>
                                                    <td class="fw-bold">{{ $bankInfo['account_number'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Account Type</th>
                                                    <td>Current Account</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Branch</th>
                                                    <td>{{ $bankInfo['branch'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Routing Number</th>
                                                    <td>{{ $bankInfo['routing_number'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">SWIFT Code</th>
                                                    <td class="text-uppercase">{{ $bankInfo['swift_code'] }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Payment Instructions -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-list-ol"></i> Step-by-Step Instructions</h5>
                                </div>
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item border-0">
                                            Go to your bank (online or branch)
                                        </li>
                                        <li class="list-group-item border-0">
                                            Use the bank details provided above
                                        </li>
                                        <li class="list-group-item border-0">
                                            Transfer <strong class="text-danger">${{ number_format($booking->total_amount, 2) }}</strong>
                                        </li>
                                        <li class="list-group-item border-0">
                                            Include booking reference <strong>{{ $booking->booking_reference }}</strong> in transfer description
                                        </li>
                                        <li class="list-group-item border-0">
                                            Save/print the transaction receipt
                                        </li>
                                        <li class="list-group-item border-0">
                                            Upload receipt using the form below
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Upload Receipt Section -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-upload"></i> Upload Payment Receipt</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('payment.upload.receipt') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="transaction_id" class="form-label">Bank Transaction ID *</label>
                                        <input type="text" class="form-control" id="transaction_id" name="transaction_id" required>
                                        <div class="form-text">The transaction ID provided by your bank</div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="transfer_date" class="form-label">Transfer Date *</label>
                                        <input type="date" class="form-control" id="transfer_date" name="transfer_date" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="receipt" class="form-label">Upload Receipt (PDF/Image) *</label>
                                    <input type="file" class="form-control" id="receipt" name="receipt" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <div class="form-text">Max file size: 5MB. Accepted: PDF, JPG, PNG</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Additional Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Any additional information about the transfer..."></textarea>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-paper-plane"></i> Submit Receipt
                                    </button>
                                </div>
                            </form>
                            
                            <div class="alert alert-info mt-4">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Important:</strong> 
                                <ul class="mb-0 mt-2">
                                    <li>Please upload the receipt as soon as you make the transfer</li>
                                    <li>Your booking will be confirmed within 24 hours of receipt verification</li>
                                    <li>You will receive confirmation email once payment is verified</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Alternative Options -->
                    <div class="mt-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('payment.cancel') }}" class="btn btn-outline-danger">
                                <i class="fas fa-times"></i> Cancel Booking
                            </a>
                            <a href="{{ route('payment.book.form', ['room_id' => $booking->room_id]) }}" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-credit-card"></i> Change to Online Payment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5 class="mb-3">Need Assistance?</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-phone text-primary me-2"></i>
                                <div>
                                    <div class="small">Call Us</div>
                                    <div class="fw-bold">+880 1234-567890</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <div>
                                    <div class="small">Email Us</div>
                                    <div class="fw-bold">accounts@hotel.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <div>
                                    <div class="small">Bank Hours</div>
                                    <div class="fw-bold">10:00 AM - 4:00 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.step-circle {
    font-weight: bold;
    border: 3px solid #dee2e6;
}

.step-label {
    font-size: 0.9rem;
    color: #6c757d;
}

.bank-info table th {
    width: 40%;
}
</style>

<script>
// Auto-set transfer date to today
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('transfer_date').value = today;
    
    // Add countdown timer
    const expiryTime = new Date();
    expiryTime.setHours(expiryTime.getHours() + 24);
    
    function updateCountdown() {
        const now = new Date();
        const diff = expiryTime - now;
        
        if (diff <= 0) {
            document.getElementById('countdown').innerHTML = 'EXPIRED';
            return;
        }
        
        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('countdown').innerHTML = 
            `${hours}h ${minutes}m ${seconds}s`;
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endsection