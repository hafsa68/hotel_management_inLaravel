 <div class="main-menu">
     <!-- Brand Logo -->
     <div class="logo-box">
         <!-- Brand Logo Light -->
         <a href="index.html" class="logo-light">
             <img src="{{url('')}}/assets/images/logo-light.png" alt="logo" class="logo-lg" height="28">
             <img src="{{url('')}}/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
         </a>

         <!-- Brand Logo Dark -->
         <a href="index.html" class="logo-dark">
             <img src="{{url('')}}/assets/images/logo-dark.png" alt="dark logo" class="logo-lg" height="28">
             <img src="{{url('')}}/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
         </a>
     </div>

     <!--- Menu -->
     <div data-simplebar>
         <ul class="app-menu">
             <li class="menu-item mt-2 px-2">
                 <a href="#"
                     class="btn btn-primary w-100 text-white waves-effect waves-light d-flex align-items-center justify-content-center"
                     style="padding: 10px 0; border-radius: 8px;">
                     <i class="bx bx-plus-circle me-2 fs-18"></i>
                     <span class="menu-text"> New Reservation </span>
                 </a>
             </li>
             <li class="menu-title">Menu</li>

             <li class="menu-item">
                 <a href="{{ route('dashboard') }}" class="menu-link waves-effect waves-light">
                     <span class="menu-icon"><i class="fas fa-tachometer-alt me-2"></i></span>
                     <span class="menu-text"> Dashboards </span>
                     <span class="badge bg-primary rounded ms-auto">01</span>
                 </a>
             </li>





             <li class="menu-title">Components</li>

             
             <li class="menu-item">
                 <a href="{{ route('user.bookings') }}" class="menu-link waves-effect waves-light">
                     <span class="menu-icon"><i class="fa-solid fa-receipt"></i></span>

                     <span class="menu-text">My Bookings</span>
                 </a>
             </li>
              
                <li class="menu-item">
                    <a href="{{route('profile') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="fas fa-user me-2"></i></span>
                        <span class="menu-text">Profile</span>
                    </a>
                </li>
    
           


          

             </li>





         </ul>

     </div>

 </div>