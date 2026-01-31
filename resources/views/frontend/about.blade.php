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
  <main>
            
            <!-- breadcrumb-area -->
            <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/bg/bdrc-bg.jpg)">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-lg-12">
                            <div class="breadcrumb-wrap text-center">
                                <div class="breadcrumb-title">
                                    <h2>About</h2>    
                                    <div class="breadcrumb-wrap">
                              
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('')}}/assets/frontend/index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">About</li>
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
            <!-- about-area -->
            <section class="about-area about-p pt-120 pb-120 p-relative fix">              
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                         <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="p-relative  wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                                <img src="{{url('')}}/assets/frontend/img/features/feature.png" alt="img">  
                            </div>
                        </div>
                        
					<div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="about-content s-about-content  wow fadeInRight  animated pl-60" data-animation="fadeInRight" data-delay=".4s">
                                <div class="section-title second-title pb-25">  
                                    <h5>About Us</h5>
                                    <h2>Most Safe & Rated Hotel <span>In London.</span></h2>                                   
                                </div>
                                   <p>Morbi tortor urna, placerat vel arcu quis, fringilla egestas neque. Morbi sit amet porta erat, quis rutrum risus. Vivamus et gravida nibh, quis posuere felis. In commodo mi lectus, Integer ligula lorem, finibus vitae lorem vitae tincidunt dolor consequat quis.</p>
                                   
                                    <div class="about-content3 mt-30">
                                    <div class="row justify-content-center align-items-center">
                                    <div class="col-md-12">
                                         <ul class="green mb-30">                                              
                                                    <li> 24 Month / 24,000km Nationwide Warranty monotone</li>
                                                    <li> Curabitur dapibus nisl a urna congue, in pharetra urna accumsan.</li>     
                                                    <li> Customer Rewards Program and excellent technology</li>
                                               </ul>
                                        </div>                                         
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                     
                    </div>
                </div>
            </section>
            <!-- about-area-end -->
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
            <section class="about-area about-p pt-120 pb-120 fix p-relative">
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
                                <a href="{{url('')}}/assets/frontend/https://www.youtube.com/watch?v=gyGsPlt06bo" class="popup-video"> <img src="{{url('')}}/assets/frontend/img/features/about.jpg" alt="img">   </a>
                               <div class="about-icon">
                                     <img src="{{url('')}}/assets/frontend/img/features/since.png" alt="img">   
                                </div>
                            </div>
                          
                        </div> 
                    </div>
                </div>
            </section>
            <!-- about-area-end -->
            
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

@endsection




   

		