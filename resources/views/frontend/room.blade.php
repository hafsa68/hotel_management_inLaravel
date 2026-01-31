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
        <!-- header-end -->
        
        <!-- main-area -->

        @section('content')
        <main>
       <!-- breadcrumb-area -->
            <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/bg/bdrc-bg.jpg)">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-lg-12">
                            <div class="breadcrumb-wrap text-center">
                                <div class="breadcrumb-title">
                                    <h2>Our Menu</h2>    
                                    <div class="breadcrumb-wrap">
                              
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('')}}/assets/frontend/index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Our Room</li>
                                    </ol>
                                </nav>
                            </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->
			  <!-- room-area-->
            <section id="services" class="services-area pt-120 pb-90">
              
                <div class="container">
                    
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="single-services ser-m mb-30">
                                <div class="services-thumb">
									<a class="gallery-link popup-image" href="{{url('')}}/assets/frontend/img/gallery/room-img01.png">
                                    <img src="{{url('')}}/assets/frontend/img/gallery/room-img01.png" alt="img">
									</a>
                                </div>
                                <div class="services-content text-center">                                    
                                    <h4><a href="{{url('')}}/assets/frontend/single-rooms.html">Classic Balcony Room</a></h4>    
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically.</p>
                                    <div class="icon">
                                        <ul>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon1.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon2.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon3.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon4.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon5.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon6.png" alt="img"></li>
                                        </ul>
                                    </div>
                                     <div class="day-book">
                                        <ul>
                                            <li>$600/Night</li>
                                            <li><a href="{{url('')}}/assets/frontend/contact.html">Book Now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                           <div class="single-services ser-m mb-30">
                                <div class="services-thumb">
									<a class="gallery-link popup-image" href="{{url('')}}/assets/frontend/img/gallery/room-img02.png">
                                    <img src="{{url('')}}/assets/frontend/img/gallery/room-img02.png" alt="img">
									</a>
                                </div>
                                <div class="services-content text-center">                                     
                                    <h4><a href="{{url('')}}/assets/frontend/single-rooms.html">Superior Double Room</a></h4>    
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically.</p>
                                    <div class="icon">
                                        <ul>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon1.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon2.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon3.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon4.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon5.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon6.png" alt="img"></li>
                                        </ul>
                                    </div>
                                    <div class="day-book">
                                        <ul>
                                            <li>$400/Night</li>
                                            <li><a href="{{url('')}}/assets/frontend/contact.html">Book Now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="single-services ser-m mb-30">
                                <div class="services-thumb">
									<a class="gallery-link popup-image" href="{{url('')}}/assets/frontend/img/gallery/room-img03.png">
                                    <img src="{{url('')}}/assets/frontend/img/gallery/room-img03.png" alt="img">
									</a>
                                </div>
                                <div class="services-content text-center">                                     
                                    <h4><a href="{{url('')}}/assets/frontend/single-rooms.html">Super Balcony Double Room</a></h4>    
                                     <p>Visitors to your city need to eat. In fact, some people visit new towns specifically.</p>
                                    <div class="icon">
                                        <ul>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon1.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon2.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon3.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon4.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon5.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon6.png" alt="img"></li>
                                        </ul>
                                    </div>
                                    <div class="day-book">
                                        <ul>
                                            <li>$100/Night</li>
                                            <li><a href="{{url('')}}/assets/frontend/contact.html">Book Now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                           <div class="single-services ser-m mb-30">
                                <div class="services-thumb">
									<a class="gallery-link popup-image" href="{{url('')}}/assets/frontend/img/gallery/room-img04.png">
                                    <img src="{{url('')}}/assets/frontend/img/gallery/room-img04.png" alt="img">
									</a>
                                </div>
                                <div class="services-content text-center">                                  
                                    <h4><a href="{{url('')}}/assets/frontend/single-rooms.html">Delux Double Room</a></h4>    
                                  <p>Visitors to your city need to eat. In fact, some people visit new towns specifically.</p>
                                    <div class="icon">
                                        <ul>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon1.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon2.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon3.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon4.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon5.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon6.png" alt="img"></li>
                                        </ul>
                                    </div>
                                       <div class="day-book">
                                        <ul>
                                            <li>$300/Night</li>
                                            <li><a href="{{url('')}}/assets/frontend/contact.html">Book Now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                           <div class="single-services ser-m mb-30">
                                <div class="services-thumb">
									<a class="gallery-link popup-image" href="{{url('')}}/assets/frontend/img/gallery/room-img05.png">
                                    <img src="{{url('')}}/assets/frontend/img/gallery/room-img05.png" alt="img">
									</a>
                                </div>
                              <div class="services-content text-center">                                  
                                    <h4><a href="{{url('')}}/assets/frontend/single-rooms.html">Superior Double Room</a></h4>    
                                    <p>Visitors to your city need to eat. In fact, some people visit new towns specifically.</p>
                                    <div class="icon">
                                        <ul>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon1.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon2.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon3.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon4.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon5.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon6.png" alt="img"></li>
                                        </ul>
                                    </div>
                                      <div class="day-book">
                                        <ul>
                                            <li>$400/Night</li>
                                            <li><a href="{{url('')}}/assets/frontend/contact.html">Book Now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="single-services ser-m mb-30">
                                <div class="services-thumb">
									<a class="gallery-link popup-image" href="{{url('')}}/assets/frontend/img/gallery/room-img06.png">
                                    <img src="{{url('')}}/assets/frontend/img/gallery/room-img06.png" alt="img">
									</a>
                                </div>
                               <div class="services-content text-center">                                  
                                    <h4><a href="{{url('')}}/assets/frontend/single-rooms.html">Super Balcony Double Room</a></h4>    
                                   <p>Visitors to your city need to eat. In fact, some people visit new towns specifically.</p>
                                    <div class="icon">
                                        <ul>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon1.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon2.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon3.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon4.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon5.png" alt="img"></li>
                                            <li><img src="{{url('')}}/assets/frontend/img/icon/sve-icon6.png" alt="img"></li>
                                        </ul>
                                    </div>
                                      <div class="day-book">
                                        <ul>
                                            <li>$100/Night</li>
                                            <li><a href="{{url('')}}/assets/frontend/contact.html">Book Now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- room-area-end -->    
              <!-- booking-area -->
            <section class="booking pb-120 p-relative fix">
                <div class="container">
                    <div class="row align-items-center">
                         <div class="col-lg-6 col-md-12">
                             <div class="booking-img">
                                 <img src="{{url('')}}/assets/frontend/img/bg/booking-img.png" alt="img">
                                 <div class="text">
                                    <h3>Seasonal or <span>Citywide Events</span></h3>
                                     <p>What big annual or seasonal events are can’t-miss?</p>
                                 </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                             <div class="contact-bg02 pl-40 pr-30">
                                <div class="section-title center-align">
                                    <h2>
                                      Book Your <span>Seat</span>
                                    </h2>
                                </div>                                
                                <form action="mail.php" method="post" class="contact-form mt-30">
                                    <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="contact-field p-relative c-name mb-20">                                    
                                           <label>Check In Date</label>
                                            <input type="date" id="chackin2" name="date">
                                        </div>                               
                                    </div>

                                     <div class="col-lg-12 col-md-12">
                                        <div class="contact-field p-relative c-subject mb-20">                                   
                                           <label>Check Out Date</label>
                                            <input type="date" id="chackout2" name="date">
                                        </div>
                                    </div>		
                                     <div class="col-lg-12 col-md-12">
                                        <div class="contact-field p-relative c-subject mb-20">                                   
                                             <label>Adults</label>
                                                <select name="adults" id="adu2">
                                                  <option value="sports-massage">Adults</option>
                                                  <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                        </div>
                                    </div>	
                                     <div class="col-lg-12 col-md-12">
                                        <div class="contact-field p-relative c-option mb-20">                                   
                                            <label>Room</label>
                                               <select name="room" id="rm2">
                                                  <option value="sports-massage">Room</option>
                                                  <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="slider-btn mt-30">                                          
                                                    <button class="btn active" data-animation="fadeInRight" data-delay=".8s"><span>Book Table Now</span></button>				
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
             <!-- feature-area -->
            <section class="feature-area2 p-relative fix" style="background: #2C45490F;">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                         <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
                           <div class="feature-img">                               
                                  <img src="{{url('')}}/assets/frontend/img/features/feature.png" alt="img" class="img">              
                                </div>
                        </div>
					   <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="feature-content s-about-content pl-60">
                                <div class="section-title pb-20">                               
                                    <h5>Luxury Hotel& Resort</h5>
                                <h2>
                                    Pearl Of  <span>The Adriatic.</span>
                                </h2>                             
                                </div>
                                <p>Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at.</p>
                                <p>Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.</p>
                                <div class="slider-btn mt-15">                                          
                                                 <a href="{{url('')}}/assets/frontend/about.html" class="btn ss-btn smoth-scroll">Discover More</a>				
                                            </div>
                                
                            </div>
                        </div>
                       
                     
                    </div>
                </div>
            </section>
            <!-- feature-area-end -->
           <!-- testimonial-area -->
            <section class="testimonial-area pt-120 pb-120 p-relative fix" style="background-image: url(img/bg/testimonial-bg.png); background-repeat: no-repeat;background-position: center center;">
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
            <section  class="instagram-area p-relative fix pb-120">                
                <div class="container-fluid">                   
                     <div class="row">
                        <div class="col-lg-2 col-sm-6">
                            <div class="instagram-box">
                                 <img src="{{url('')}}/assets/frontend/img/bg/ins-img-01.png" alt="img">
                                <div class="hover"><a href="{{url('')}}/assets/frontend/#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="instagram-box">
                                 <img src="{{url('')}}/assets/frontend/img/bg/ins-img-02.png" alt="img">
                                <div class="hover"><a href="{{url('')}}/assets/frontend/#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="instagram-box">
                                 <img src="{{url('')}}/assets/frontend/img/bg/ins-img-03.png" alt="img">
                                 <div class="hover"><a href="{{url('')}}/assets/frontend/#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="instagram-box">
                                 <img src="{{url('')}}/assets/frontend/img/bg/ins-img-04.png" alt="img">
                                <div class="hover"><a href="{{url('')}}/assets/frontend/#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="instagram-box">
                                 <img src="{{url('')}}/assets/frontend/img/bg/ins-img-05.png" alt="img">
                                 <div class="hover"><a href="{{url('')}}/assets/frontend/#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                            </div>
                        </div>
                       <div class="col-lg-2 col-sm-6">
                            <div class="instagram-box">
                                 <img src="{{url('')}}/assets/frontend/img/bg/ins-img-06.png" alt="img">
                                 <div class="hover"><a href="{{url('')}}/assets/frontend/#"><img src="{{url('')}}/assets/frontend/img/icon/instagram-icon.png" alt="img"></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- instagram-area-end -->
            
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
        <!-- main-area-end -->
   @endsection