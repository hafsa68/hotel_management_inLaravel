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
                                    <a href="{{ route('home') }}">
                                        <img src="{{ url('') }}/assets/frontend/img/logo/logo.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                                <div class="main-menu text-center">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('frontend.about') }}">About</a></li>        
                                            <li class="has-sub">
                                                <a href="#">Our Rooms</a>
                                                <ul>													
                                                    <li><a href="{{ route('frontend.rooms') }}">All Rooms</a></li>
                                                    @foreach(App\Models\Room::where('status', 'active')->take(3)->get() as $room)
                                                    <li><a href="{{ route('frontend.room.details', $room->id) }}">{{ $room->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>     
                                            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>                                               
                                            
                                            <!-- Authentication Links -->
                                            @auth
                                                <!-- লগইন থাকলে -->
                                                <li class="has-sub">
                                                    <a href="javascript:void(0)" class="glass-btn">
                                                        <i class="fas fa-user"></i> {{ auth()->user()->name }}
                                                    </a>
                                                    <ul>													
                                                        <li><a href="#">Dashboard</a></li>
                                                        <li><a href="#">My Bookings</a></li>
                                                        <li><a href="#">Profile</a></li>
                                                        <li>
                                                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item text-danger" style="background: none; border: none; padding: 0;">
                                                                    <i class="fas fa-sign-out-alt"></i> Logout
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @else
                                                <!-- লগইন না থাকলে -->
                                                <li>
                                                    <a href="{{ route('login') }}" class="glass-btn">
                                                        <i class="fas fa-sign-in-alt"></i> Login
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('register') }}" class="glass-btn" style="background: #ff6b6b;">
                                                        <i class="fas fa-user-plus"></i> Register
                                                    </a>
                                                </li>
                                            @endauth
                                        </ul>
                                    </nav>
                                </div>
                            </div>   
                            <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                                <a href="{{ route('frontend.rooms') }}" class="top-btn mt-10 mb-10">Book Now</a>
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
        <style>
    /* Glass button styles */
    .glass-btn {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        color: white !important;
        padding: 8px 20px;
        border-radius: 4px;
        text-decoration: none;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: 0.4s;
        margin-left: 10px;
    }
    
    .glass-btn:hover {
        background: white;
        color: #000 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    /* Login/Register specific */
    .glass-btn i {
        margin-right: 5px;
    }
    
    /* User dropdown */
    .has-sub .glass-btn {
        background: rgba(40, 167, 69, 0.2);
    }
    
    /* Active menu item */
    #mobile-menu li.active > a {
        color: #28a745 !important;
        font-weight: 600;
    }
    
    /* Top button (Book Now) */
    .top-btn {
        display: inline-block;
        background: #28a745;
        color: white !important;
        padding: 10px 25px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
    }
    
    .top-btn:hover {
        background: #218838;
        color: white !important;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
    }
    
    /* Logout button in dropdown */
    .dropdown-item.text-danger {
        cursor: pointer;
        color: #dc3545 !important;
    }
    
    .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
    }
</style>
<style>
    /* Mobile responsiveness */
    @media (max-width: 991px) {
        .glass-btn {
            margin: 5px;
            display: block;
            text-align: center;
        }
        
        #mobile-menu ul ul {
            background: rgba(0, 0, 0, 0.8);
        }
        
        .has-sub .glass-btn {
            width: 100%;
            margin-bottom: 5px;
        }
    }
    
    /* Dropdown menu */
    #mobile-menu ul ul {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    #mobile-menu ul ul li a {
        color: #333 !important;
        padding: 8px 20px;
    }
    
    #mobile-menu ul ul li a:hover {
        background: #28a745;
        color: white !important;
    }
</style>
        <!-- main-area -->
        @yield("content")
        <!-- main-area-end -->
        
        <!-- footer -->
        @include("frontend.layouts.footer")
        <!-- footer-end -->
        
        <!-- JS here -->
        <script src="{{ url('') }}/assets/frontend/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/vendor/jquery.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/popper.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/bootstrap.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/slick.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/ajax-form.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/paroller.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/wow.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/js_isotope.pkgd.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/imagesloaded.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/parallax.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/jquery.waypoints.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/jquery.counterup.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/jquery.scrollUp.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/jquery.meanmenu.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/parallax-scroll.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/jquery.magnific-popup.min.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/element-in-view.js"></script>
        <script src="{{ url('') }}/assets/frontend/js/main.js"></script>
        
        <!-- Custom Script -->
        <script>
            $(document).ready(function() {
                // Handle logout form submission
                $('.logout-form button').click(function(e) {
                    if (!confirm('Are you sure you want to logout?')) {
                        e.preventDefault();
                    }
                });
                
                // Add active class to current page
                var currentUrl = window.location.href;
                $('#mobile-menu a').each(function() {
                    if ($(this).attr('href') === currentUrl) {
                        $(this).addClass('active');
                        $(this).parents('li').addClass('active');
                    }
                });
            });





        
    $(document).ready(function() {
        // User dropdown toggle
        $('.has-sub .glass-btn').click(function(e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                $(this).next('ul').slideToggle();
            }
        });
        
        // Close dropdown when clicking outside
        $(document).click(function(e) {
            if (!$(e.target).closest('.has-sub').length) {
                $('.has-sub ul').slideUp();
            }
        });
        
        // Update login/register button text based on auth status
        function updateAuthButtons() {
            if ($('body').hasClass('logged-in')) {
                // Already handled by Blade
            }
        }
        
        // Initialize
        updateAuthButtons();
    });

        </script>
    </body>
</html>