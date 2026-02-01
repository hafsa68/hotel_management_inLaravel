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
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-body text-center p-5">
                    <!-- Fail Icon -->
                    <div class="mb-4">
                        <div class="fail-icon d-inline-flex align-items-center justify-content-center rounded-circle bg-danger" 
                             style="width: 100px; height: 100px; font-size: 48px;">
                            <i class="fas fa-times text-white"></i>
                        </div>
                    </div>
                    
                    <!-- Fail Message -->
                    <h2 class="text-danger mb-3">Payment Failed!</h2>
                    <p class="lead mb-4">We're sorry, but your payment could not be processed.</p>
                    
                    <!-- Error Details -->
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle"></i> Possible Reasons:</h5>
                        <ul class="mb-0">
                            <li>Insufficient funds in your account</li>
                            <li>Incorrect card details entered</li>
                            <li>Bank server is temporarily unavailable</li>
                            <li>Transaction declined by your bank</li>
                        </ul>
                    </div>
                    
                    <!-- What to Do -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">What should you do?</h5>
                        </div>
                        <div class="card-body text-start">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle p-2">1</span>
                                        </div>
                                        <div>
                                            <h6>Check Your Payment Method</h6>
                                            <p class="text-muted mb-0">Verify your card/bank account details</p>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex mb-3">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle p-2">2</span>
                                        </div>
                                        <div>
                                            <h6>Contact Your Bank</h6>
                                            <p class="text-muted mb-0">Ensure no restrictions on online payments</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle p-2">3</span>
                                        </div>
                                        <div>
                                            <h6>Try Again</h6>
                                            <p class="text-muted mb-0">Wait a few minutes and retry payment</p>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <span class="badge bg-primary rounded-circle p-2">4</span>
                                        </div>
                                        <div>
                                            <h6>Contact Support</h6>
                                            <p class="text-muted mb-0">If problem persists, contact our support</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Alternative Payment Methods -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Alternative Payment Methods</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                                        <h6>Cash on Arrival</h6>
                                        <p class="small text-muted">Pay when you arrive at hotel</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <i class="fas fa-university fa-2x text-primary mb-2"></i>
                                        <h6>Bank Transfer</h6>
                                        <p class="small text-muted">Direct bank to bank transfer</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded p-3 h-100">
                                        <i class="fas fa-mobile-alt fa-2x text-info mb-2"></i>
                                        <h6>Mobile Banking</h6>
                                        <p class="small text-muted">bKash, Nagad, Rocket</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-3 d-md-flex justify-content-center mt-4">
                        <a href="{{ URL::previous() }}" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-redo"></i> Try Payment Again
                        </a>
                        <a href="{{ route('frontend.rooms') }}" class="btn btn-outline-primary btn-lg px-4">
                            <i class="fas fa-bed"></i> Browse Rooms
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                    </div>
                    
                    <!-- Support Contact -->
                    <div class="mt-5 pt-4 border-top">
                        <h5>Need Help?</h5>
                        <p class="text-muted">Contact our support team for assistance</p>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <i class="fas fa-phone text-primary mb-2"></i>
                                        <h6>Call Us</h6>
                                        <p class="mb-0">+880 1234-567890</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <i class="fas fa-envelope text-primary mb-2"></i>
                                        <h6>Email Us</h6>
                                        <p class="mb-0">support@hotel.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection