@extends('frontend.layouts.master')
@section("header")
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

@section("content")
<main>
    <!-- slider-area -->
    <section id="home" class="slider-area fix p-relative">
        <!-- slider-info-area -->
        <div class="slider-info">                   
            <div class="social">
                <span>
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>               
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-youtube"></i></a>
                </span>                    
            </div>
            <div class="email">
                <span class="mr-15">info@dahotel.com</span> +(123) 456 789
            </div>
        </div>
        <!-- slider-info-area-end -->
        <div class="slider-active" style="background: #101010;">
            <div class="single-slider slider-bg d-flex align-items-center" style="background-image: url('{{ url('') }}/assets/frontend/img/slider/slider_bg.jpg'); background-size: cover;">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="slider-content s-slider-content mt-80 text-center">
                                <h5 data-animation="fadeInUp" data-delay=".4s">LUXURY HOTEL & BEST RESORT</h5>
                                <h2 data-animation="fadeInUp" data-delay=".4s">Enjoy A Luxury <span>Experience</span></h2>                                        
                                <div class="slider-btn mt-30 mb-105">     
                                    <a href="#" class="btn ss-btn active mr-15" data-animation="fadeInLeft" data-delay=".4s">Book Now</a>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider-area-end -->
    
    <!-- booking-area -->
    <div id="booking" class="booking-area p-relative">
        <div class="container">                  
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9"> 
                    <form action="{{ route('frontend.check.availability') }}" method="GET" class="contact-form">
                        @csrf
                        <ul>
                            <li> 
                                <div class="contact-field p-relative c-name">  
                                    <label>CHECK-IN</label>
                                    <input type="date" name="check_in" id="chackin" 
                                           min="{{ date('Y-m-d') }}" required>
                                </div>      
                            </li>
                            <li> 
                                <div class="contact-field p-relative c-name">  
                                    <label>CHECK-OUT</label>
                                    <input type="date" name="check_out" id="chackout" required>
                                </div>      
                            </li>
                            <li> 
                                <div class="contact-field p-relative c-name">  
                                    <label>ROOM TYPE</label>
                                    <select name="room_id" id="room_type" required>
                                        <option value="">Select Room Type</option>
                                        @if(isset($roomTypes) && $roomTypes->count() > 0)
                                            @foreach($roomTypes as $room)
                                                <option value="{{ $room->id }}">
                                                    {{ $room->name }} - ${{ $room->fare }}/night
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>      
                            </li>                                 
                            <li> 
                                <div class="contact-field p-relative c-name mt-10 mb-10">  
                                    <input type="text" name="guest_name" placeholder="Your Name">
                                </div>      
                                <div class="contact-field p-relative c-name mb-10">  
                                    <input type="email" name="guest_email" placeholder="Your Email">
                                </div>
                            </li>
                            <li>
                                <div class="slider-btn">    
                                    <button type="submit" class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s">Check Availability</button>
                                </div>     
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- booking-area-end -->
    
    <!-- service-details2-area -->
    <section id="service-details2" class="pt-120 pb-90 p-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-title center-align mb-50">
                        <h5>why choose us</h5>
                        <h2>Why <span>choose us</span></h2>                                
                    </div>                           
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="services-08-item mb-70">                                    
                                <div class="services-08-thumb">
                                    <img src="{{url('')}}/assets/frontend/img/icon/fe-icon01.png" alt="img">
                                </div>
                                <div class="services-08-content">
                                    <h3><a href="#">Restaurants</a></h3>
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically for the food. Use your insider</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-08-item mb-70">                                                 
                                <div class="services-08-thumb">
                                    <img src="{{url('')}}/assets/frontend/img/icon/fe-icon02.png" alt="img">
                                </div>
                                <div class="services-08-content">
                                    <h3><a href="#">Luxury Room</a></h3>
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically for the food. Use your insider</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-08-item mb-70">                                        
                                <div class="services-08-thumb">
                                    <img src="{{url('')}}/assets/frontend/img/icon/fe-icon03.png" alt="img">
                                </div>
                                <div class="services-08-content">
                                    <h3><a href="#">Entertainment</a></h3>
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically for the food. Use your insider</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-08-item mb-70">                        
                                <div class="services-08-thumb">
                                    <img src="{{url('')}}/assets/frontend/img/icon/fe-icon04.png" alt="img">
                                </div>
                                <div class="services-08-content">
                                    <h3><a href="#">Pool Area</a></h3>
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically for the food. Use your insider</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-08-item mb-70">                           
                                <div class="services-08-thumb">
                                    <img src="{{url('')}}/assets/frontend/img/icon/fe-icon05.png" alt="img">
                                </div>
                                <div class="services-08-content">
                                    <h3><a href="#">Cocktail Bar</a></h3>
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically for the food. Use your insider</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="services-08-item mb-70">                        
                                <div class="services-08-thumb">
                                    <img src="{{url('')}}/assets/frontend/img/icon/fe-icon06.png" alt="img">
                                </div>
                                <div class="services-08-content">
                                    <h3><a href="#">Tour Guide</a></h3>
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically for the food. Use your insider</p>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </section>
    <!-- service-details2-area-end -->
    
    <!-- counter-area -->
    <div class="counter-area p-relative wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
        <div class="container">
            <div class="row p-relative align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-counter text-center">
                        <div class="counter p-relative">                                   
                            <div class="text">
                                <span class="count">90</span><span>K</span>                               
                                <p>Guest Have Stayed at Our Hotel</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-counter text-center">
                        <div class="counter p-relative">                                   
                            <div class="text">
                                <span class="count">152</span><span>+</span>                               
                                <p>Guest Have Stayed at Our Hotel</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="single-counter text-center">
                        <div class="counter p-relative">                                
                            <div class="text">
                                <span class="count">221</span><span>+</span>     
                                <p>Our Luxurious Services Rooms</p>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
        </div>
    </div>
    <!-- counter-area-end -->	
    
    <!-- about-area -->
    <section class="about-area about-p pt-120 pb-60 fix p-relative">
        <div class="scrollbox2">
            <div class="scrollbox scrollbox--secondary scrollbox--reverse">
                <div class="scrollbox__item"> <div class="section-t"><h2>luxury Hotel / Quality Living In DaHotel</h2></div></div>
                <div class="scrollbox__item"> <div class="section-t"><h2>luxury Hotel / Quality Living In DaHotel</h2></div></div>
                <div class="scrollbox__item"> <div class="section-t"><h2>luxury Hotel / Quality Living In DaHotel</h2></div></div>
            </div>         
        </div>                 
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="s-about-img p-relative  wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                        <a href="https://www.youtube.com/watch?v=gyGsPlt06bo" class="popup-video"> 
                            <img src="{{url('')}}/assets/frontend/img/features/about.jpg" alt="img">
                        </a>
                        <div class="about-icon">
                            <img src="{{url('')}}/assets/frontend/img/features/since.png" alt="img">
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    <!-- about-area-end -->
    
    <!-- room-area-->
    <section id="services" class="services-area pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9">    
                    <div class="section-title center-align mb-80 text-center">
                        <div class="icon mb-50"> 
                            <img src="{{url('')}}/assets/frontend/img/icon/hotel-icon-sub.png" alt="img">
                        </div>
                        <h5>Our Featured Rooms</h5>
                        <h2>Hotel <span>Rooms</span></h2>
                        <p>Experience luxury and comfort in our beautifully designed rooms with modern amenities.</p>
                        <div class="mt-30">     
                            <a href="{{ route('frontend.rooms') }}" class="btn ss-btn mr-15">View All Rooms</a>
                        </div>
                    </div>
                </div>
            </div>
            
            @if(isset($roomTypes) && $roomTypes->count() > 0)
            <div class="row services-active">
                @foreach($roomTypes as $room)
                <div class="col-xl-4 col-md-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-thumb">
                            <a href="{{ route('frontend.room.details', $room->id) }}">
                                <img src="{{ asset($room->image ?? url('') . '/assets/frontend/img/gallery/room-img01.png') }}" 
                                     alt="{{ $room->name }}" style="height: 250px; object-fit: cover;">
                            </a>
                        </div>
                        <div class="services-content">                                     
                            <h4><a href="{{ route('frontend.room.details', $room->id) }}">{{ $room->name }}</a></h4>    
                            <p>{{ Str::limit($room->description ?? 'Luxury room with modern amenities', 100) }}</p>
                            <div class="icon">
                                <ul>
                                    <li><img src="{{ url('') }}/assets/frontend/img/icon/sve-icon1.png" alt="WiFi" title="Free WiFi"></li>
                                    <li><img src="{{ url('') }}/assets/frontend/img/icon/sve-icon2.png" alt="TV" title="LED TV"></li>
                                    <li><img src="{{ url('') }}/assets/frontend/img/icon/sve-icon3.png" alt="AC" title="Air Conditioning"></li>
                                    <li><img src="{{ url('') }}/assets/frontend/img/icon/sve-icon4.png" alt="Bed" title="Comfortable Bed"></li>
                                </ul>
                            </div>
                            <div class="day-book">
                                <ul>
                                    <li>${{ $room->fare }}/Night</li>
                                    <li><a href="{{ route('frontend.room.details', $room->id) }}">Book Now</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center">
                <p>No rooms available at the moment.</p>
            </div>
            @endif
        </div>
    </section>
    <!-- room-area-end -->    
    
    <!-- feature-area -->
    <section class="feature-area2 p-relative pt-120 pb-120 fix" style="background: #2C4549;">              
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 pr-30">
                    <div class="feature-slider-active">                               
                        <div class="feature-slider-box">                                   
                            <img src="{{url('')}}/assets/frontend/img/bg/feature-slider-img.png" alt="contact-bg-an-01">
                            <div class="text">
                                <h2>Minimal Duplex Room /</h2>
                            </div>
                        </div>                          
                        <div class="feature-slider-box">                                   
                            <img src="{{url('')}}/assets/frontend/img/bg/feature-slider-img.png" alt="contact-bg-an-01">
                            <div class="text">
                                <h2>wifi bed water house /</h2>
                            </div>
                        </div>
                        <div class="feature-slider-box">                                   
                            <img src="{{url('')}}/assets/frontend/img/bg/feature-slider-img.png" alt="contact-bg-an-01">
                            <div class="text">
                                <h2>free wifi zone /</h2>
                            </div>
                        </div>
                        <div class="feature-slider-box">                                   
                            <img src="{{url('')}}/assets/frontend/img/bg/feature-slider-img.png" alt="contact-bg-an-01">
                            <div class="text">
                                <h2>wifi bed water house /</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature-area-end -->
    
    <!-- pricing-area -->
    <section id="pricing" class="pricing-area pt-120 pb-60 fix p-relative">
        <div class="container"> 
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="section-title mb-80 text-center">
                        <h5>our plans</h5>
                        <h2>Our pricing <span>& plans</span></h2>   
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box pricing-box2 mb-60">
                        <div class="pricng-img">
                            <img src="{{url('')}}/assets/frontend/img/bg/pr-img-01.jpg" alt="contact-bg-an-01">
                        </div>
                        <div class="pricing-head">  
                            <h3>luxury plan</h3>    
                            <div class="price-count">
                                <h2>$70</h2>
                                <span>/ Per Night</span>
                            </div> 
                            <hr>
                        </div>
                        <div class="pricing-body mt-20 mb-30">
                            <ul>
                                <li>Safe & Secure Services</li>
                                <li>Room Fast Cleaning</li>
                                <li>Drinks is Included</li>                                           
                                <li>Room Breakfast</li>                                           
                            </ul>
                        </div>   
                        <div class="pricing-btn">
                            <a href="{{ route('frontend.rooms') }}" class="btn active">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box pricing-box2 mb-60">
                        <div class="pricng-img">
                            <img src="{{url('')}}/assets/frontend/img/bg/pr-img-02.jpg" alt="contact-bg-an-01">
                        </div>
                        <div class="pricing-head">  
                            <h3>couple plan</h3>    
                            <div class="price-count">
                                <h2>$99</h2>
                                <span>/ Per Night</span>
                            </div> 
                            <hr>
                        </div>
                        <div class="pricing-body mt-20 mb-30">
                            <ul>
                                <li>Safe & Secure Services</li>
                                <li>Room Fast Cleaning</li>
                                <li>Drinks is Included</li>                                           
                                <li>Room Breakfast</li>                                           
                            </ul>
                        </div>   
                        <div class="pricing-btn">
                            <a href="{{ route('frontend.rooms') }}" class="btn active">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box pricing-box2 mb-60">
                        <div class="pricng-img">
                            <img src="{{url('')}}/assets/frontend/img/bg/pr-img-03.jpg" alt="contact-bg-an-01">
                        </div>
                        <div class="pricing-head">  
                            <h3>intro price</h3>    
                            <div class="price-count">
                                <h2>$299</h2>
                                <span>/ Per Night</span>
                            </div> 
                            <hr>
                        </div>
                        <div class="pricing-body mt-20 mb-30">
                            <ul>
                                <li>Safe & Secure Services</li>
                                <li>Room Fast Cleaning</li>
                                <li>Drinks is Included</li>                                           
                                <li>Room Breakfast</li>                                           
                            </ul>
                        </div>   
                        <div class="pricing-btn">
                            <a href="{{ route('frontend.rooms') }}" class="btn active">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing-area-end -->
    
    <!-- Second Booking Form -->
    <section class="booking pb-120 p-relative fix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="booking-img">
                        <img src="{{ url('') }}/assets/frontend/img/bg/booking-img.png" alt="img">
                        <div class="text">
                            <h3>Book Your <span>Perfect Stay</span></h3>
                            <p>Experience luxury and comfort in our premium rooms.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact-bg02 pl-40 pr-30">
                        <div class="section-title center-align">
                            <h2>Book Your <span>Room</span></h2>
                        </div>                                
                        <form action="{{ route('frontend.check.availability') }}" method="GET" class="contact-form mt-30">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="contact-field p-relative c-name mb-20">                                    
                                        <label>Check In Date</label>
                                        <input type="date" name="check_in" id="chackin2" 
                                               min="{{ date('Y-m-d') }}" required>
                                    </div>                               
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="contact-field p-relative c-subject mb-20">                                   
                                        <label>Check Out Date</label>
                                        <input type="date" name="check_out" id="chackout2" required>
                                    </div>
                                </div>		
                                <div class="col-lg-12 col-md-12">
                                    <div class="contact-field p-relative c-subject mb-20">                                   
                                        <label>Room Type</label>
                                        <select name="room_id" id="room_type2" required>
                                            <option value="">Select Room Type</option>
                                            @if(isset($roomTypes) && $roomTypes->count() > 0)
                                                @foreach($roomTypes as $room)
                                                    <option value="{{ $room->id }}">
                                                        {{ $room->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>	
                                <div class="col-lg-12">
                                    <div class="slider-btn mt-30">                                          
                                        <button type="submit" class="btn active" data-animation="fadeInRight" data-delay=".8s">
                                            <span>Check Availability</span>
                                        </button>				
                                    </div>                             
                                </div>
                            </div>
                        </form>                            
                    </div>                                              
                </div>
            </div>
        </div>
    </section>
    <!-- booking-area-end -->	
    
    <!-- service-area -->
    <section class="service-area pb-120 p-relative fix" style="background: #2C45490F;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                    <div class="service-link">   
                        <ul>
                            <li>
                                <div class="s-link">
                                    <div class="text">
                                        <a href="#"><h3><i class="fal fa-long-arrow-right"></i> Cafe & Wine Bar</h3> 
                                            <span>Start from <b>$150</b></span>
                                        </a>
                                    </div>
                                    <div class="layer img-hover">
                                        <img src="{{url('')}}/assets/frontend/img/bg/sr-img-01.png" alt="shape">
                                    </div>
                                </div>
                            </li>  
                            <li>
                                <div class="s-link active">
                                    <div class="text"> 
                                        <a href="#"><h3><i class="fal fa-long-arrow-right"></i> Spa & Wellness</h3> 
                                            <span>Start from <b>$100</b></span>
                                        </a>
                                    </div>
                                    <div class="layer img-hover">
                                        <img src="{{url('')}}/assets/frontend/img/bg/sr-img-02.png" alt="shape">
                                    </div>
                                </div>
                            </li>  
                            <li>
                                <div class="s-link">
                                    <div class="text"> 
                                        <a href="#"><h3><i class="fal fa-long-arrow-right"></i> Restaurant</h3> 
                                            <span>Start from <b>$130</b></span>
                                        </a>
                                    </div>
                                    <div class="layer img-hover">
                                        <img src="{{url('')}}/assets/frontend/img/bg/sr-img-03.png" alt="shape">
                                    </div>
                                </div>
                            </li>  
                            <li>
                                <div class="s-link">
                                    <div class="text">
                                        <a href="#"><h3><i class="fal fa-long-arrow-right"></i> Meetings & Events</h3> 
                                            <span>Start from <b>$140</b></span>
                                        </a>
                                    </div>
                                    <div class="layer img-hover">
                                        <img src="{{url('')}}/assets/frontend/img/bg/sr-img-04.png" alt="shape">
                                    </div>
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-area-end -->	
    
    <!-- testimonial-area -->
    <section class="testimonial-area pt-120 pb-120 p-relative fix" style="background-image: url('{{ url('') }}/assets/frontend/img/bg/testimonial-bg.png'); background-repeat: no-repeat;background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title mb-80 text-center">
                        <h5>testimonials</h5>
                        <h2>Happy users <span>says</span></h2>   
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="testimonial-active">
                        <div class="single-testimonial">
                            <h3>Best hotel to say</h3>
                            <p>“ One of the clearest ways that a hotel can stand out from the competition and wow potential guests. ”</p>
                            <div class="testi-author">                                        
                                <div class="ta-info">
                                    <h6>Rosalina William</h6>
                                    <span>ceo</span>
                                </div>
                                <img src="{{url('')}}/assets/frontend/img/testimonial/testi_avatar.png" alt="img">
                            </div>
                        </div>
                        <div class="single-testimonial">
                            <h3>Best hotel to say</h3>
                            <p>“ One of the clearest ways that a hotel can stand out from the competition and wow potential guests. ”</p>
                            <div class="testi-author">                                        
                                <div class="ta-info">
                                    <h6>Nelson Helson</h6>
                                    <span>founder</span>
                                </div>
                                <img src="{{url('')}}/assets/frontend/img/testimonial/testi_avatar_02.png" alt="img">
                            </div>
                        </div>
                        <div class="single-testimonial">
                            <h3>Best hotel to say</h3>
                            <p>“ One of the clearest ways that a hotel can stand out from the competition and wow potential guests. ”</p>
                            <div class="testi-author">                                        
                                <div class="ta-info">
                                    <h6>Tromazo Zelson</h6>
                                    <span>designer</span>
                                </div>
                                <img src="{{url('')}}/assets/frontend/img/testimonial/testi_avatar_03.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-area-end -->
    
    <!-- instagram-area -->
    <section  class="instagram-area p-relative fix">                
        <div class="container-fluid">                   
            <div class="row">
                <div class="col-lg-2 col-sm-6">
                    <div class="instagram-box">
                        <img src="{{url('')}}/assets/frontend/img/bg/ins-img-01.png" alt="img">
                        <div class="hover"><a href="#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="instagram-box">
                        <img src="{{url('')}}/assets/frontend/img/bg/ins-img-02.png" alt="img">
                        <div class="hover"><a href="#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="instagram-box">
                        <img src="{{url('')}}/assets/frontend/img/bg/ins-img-03.png" alt="img">
                        <div class="hover"><a href="#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="instagram-box">
                        <img src="{{url('')}}/assets/frontend/img/bg/ins-img-04.png" alt="img">
                        <div class="hover"><a href="#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="instagram-box">
                        <img src="{{url('')}}/assets/frontend/img/bg/ins-img-05.png" alt="img">
                        <div class="hover"><a href="#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="instagram-box">
                        <img src="{{url('')}}/assets/frontend/img/bg/ins-img-06.png" alt="img">
                        <div class="hover"><a href="#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- instagram-area-end -->
    
    <!-- blog-area -->
    <section id="blog" class="blog-area p-relative fix pt-120 pb-90">
        <div class="container">
            <div class="row align-items-center"> 
                <div class="col-lg-12">
                    <div class="section-title center-align mb-80 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                        <h5>Our Blog</h5>
                        <h2>Company news <span>& insights</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-post2 hover-zoomin mb-30 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                        <div class="blog-thumb2">
                            <a href="#"><img src="{{url('')}}/assets/frontend/img/blog/inner_b1.jpg" alt="img"></a>
                        </div>                    
                        <div class="blog-content2">                                     
                            <div class="date-home">24th March 2024</div>
                            <div class="b-meta">
                                <div class="meta-info">
                                    <ul>
                                        <li><span>By</span> Miranda H. </li>                                              
                                    </ul>
                                </div>
                            </div>
                            <h4><a href="#">Cras accumsan nulla nec lacus ultricies placerat.</a></h4>                                    
                            <div class="blog-btn"><a href="#">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-post2 mb-30 hover-zoomin wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                        <div class="blog-thumb2">
                            <a href="#"><img src="{{url('')}}/assets/frontend/img/blog/inner_b2.jpg" alt="img"></a>
                        </div>
                        <div class="blog-content2">                                    
                            <div class="date-home">24th March 2024</div>
                            <div class="b-meta">
                                <div class="meta-info">
                                    <ul>
                                        <li><span>By</span> Miranda H. </li>                                              
                                    </ul>
                                </div>
                            </div>
                            <h4><a href="#">Dras accumsan nulla nec lacus ultricies placerat.</a></h4>                                   
                            <div class="blog-btn"><a href="#">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-post2 mb-30 hover-zoomin wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                        <div class="blog-thumb2">
                            <a href="#"><img src="{{url('')}}/assets/frontend/img/blog/inner_b3.jpg" alt="img"></a>
                        </div>
                        <div class="blog-content2">                                    
                            <div class="date-home">24th March 2024</div>
                            <div class="b-meta">
                                <div class="meta-info">
                                    <ul>
                                        <li><span>By</span> Miranda H. </li>                                              
                                    </ul>
                                </div>
                            </div>
                            <h4><a href="#">Seas accumsan nulla nec lacus ultricies placerat.</a></h4>                                    
                            <div class="blog-btn"><a href="#">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-area-end -->
    
    <!-- newslater-area -->
    <section class="newslater-area">
        <div class="container p-relative">
            <div class="newslater-text">Newsletter</div>
            <div class="row align-items-center">                            
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="section-title">
                        <h2>Subscribe here <span>for update</span></h2>
                        <p>Subscribe us to receive market updates.</p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12">
                    <form name="ajax-form" id="contact-form4" action="#" method="post" class="contact-form newslater">
                        <div class="form-group">
                            <input class="form-control" id="email2" name="email" type="email" placeholder="Email Address..." value="" required=""> 
                            <button type="submit" class="btn btn-custom" id="send2">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- newslater-aread-end -->
</main>
@endsection