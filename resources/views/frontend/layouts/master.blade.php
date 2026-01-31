<!doctype html>
<html class="no-js" lang="zxx">
    @yield("header")
    <body>
        <!-- header -->
        <header class="header-area header-three">           	
			  <div id="header-sticky" class="menu-area">
                <div class="container-fluid pl-85 pr-85">
                    <div class="second-menu">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="{{url('')}}/assets/frontend/index.html"><img src="{{url('')}}/assets/frontend/img/logo/logo.png" alt="logo"></a>
                                </div>
                            </div>
                           <div class="col-xl-8 col-lg-8">
                              
                                <div class="main-menu text-center">
                                    <nav id="mobile-menu">
                                          <ul>
                                            <li class="has-sub">
                                                <a href="{{url('/pages/home')}}">Home</a>
                                               
                                            </li>
                                            <li><a href="{{url('/about')}}">About</a></li>        
                                            <li class="has-sub">
                                                <a href="{{url('/room')}}">our rooms</a>
                                                <ul>													
													<li> <a href="{{url('')}}">Our Rooms</a></li>
												</ul>
                                            </li>     
                                            <li class="has-sub">
                                                <a href="{{url('')}}/assets/frontend/services.html">Facilities</a>
                                                <ul>													
													<li> <a href="{{url('')}}/assets/frontend/services.html">Services</a></li>
                                                    <li> <a href="{{url('')}}/assets/frontend/single-service.html">Services Details</a></li>
												</ul>
                                            </li>  
                                              <li class="has-sub"><a href="{{url('')}}/assets/frontend/#">Pages</a>
												<ul>
                                                    <li><a href="{{url('')}}/assets/frontend/projects.html">Gallery</a></li>
                                                    <li><a href="{{url('')}}/assets/frontend/faq.html">Faq</a></li>
                                                    <li><a href="{{url('')}}/assets/frontend/team.html">Team</a></li>
                                                    <li><a href="{{url('')}}/assets/frontend/team-single.html">Team Details</a></li>
                                                    <li><a href="{{url('')}}/assets/frontend/pricing.html">Pricing</a></li>
                                                    <li><a href="{{url('')}}/assets/frontend/shop.html">Shop</a></li>
													<li><a href="{{url('')}}/assets/frontend/shop-details.html">Shop Details</a>
                                                  </ul>
											</li>
                                            <li class="has-sub"> 
                                                <a href="{{url('')}}/assets/frontend/blog.html">Blog</a>
                                                <ul>
                                                    <li><a href="{{url('')}}/assets/frontend/blog.html">Blog</a></li>
                                                    <li><a href="{{url('')}}/assets/frontend/blog-details.html">Blog Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{url('')}}/assets/frontend/contact.html">Contact</a></li>                                               
<li class="nav-item">
    <a href="{{ route('login') }}" class="glass-btn">
        Login
    </a>
</li>

<style>
    .glass-btn {
        
        color: white !important;
        padding: 6px 20px;
        border-radius: 2px;
        text-decoration: none;
        backdrop-filter: blur(5px);
        transition: 0.4s;
    }

    .glass-btn:hover {
        background: white;
        color: #000 !important;
    }
</style>                               </nav>
                                </div>
                            </div>   
                             <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                                 <a href="{{url('')}}/assets/frontend/contact.html" class="top-btn mt-10 mb-10">reservation </a>
                            </div>
                            
                                <div class="col-12">
                                    <div class="mobile-menu"></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header-end -->
        
        <!-- main-area -->
      @yield("content")
        <!-- main-area-end -->
    <!-- footer -->
         @include("frontend.layouts.footer")
        <!-- footer-end -->
		<!-- JS here -->
        <script src="{{url('')}}/assets/frontend/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/vendor/jquery.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/popper.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/bootstrap.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/slick.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/ajax-form.js"></script>
        <script src="{{url('')}}/assets/frontend/js/paroller.js"></script>
        <script src="{{url('')}}/assets/frontend/js/wow.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/js_isotope.pkgd.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/imagesloaded.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/parallax.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/jquery.waypoints.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/jquery.counterup.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/jquery.scrollUp.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/jquery.meanmenu.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/parallax-scroll.js"></script>
        <script src="{{url('')}}/assets/frontend/js/jquery.magnific-popup.min.js"></script>
        <script src="{{url('')}}/assets/frontend/js/element-in-view.js"></script>
        <script src="{{url('')}}/assets/frontend/js/main.js"></script>
    </body>
</html>