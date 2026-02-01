<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
    
@yield("head")

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
       


         @auth
                @if(auth()->user()->role == 'admin')
                    @include('backend.layouts.adminLeftbar')
                @elseif(auth()->user()->role == 'manager')
                    @include('backend.layouts.managerLeftbar')
                @else
                    @include('backend.layouts.leftbar')
                @endif
            @endauth
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
             @if(Auth::guard('web')->check())
               @include("backend.layouts.header")
            @elseif (Auth::guard('admin')->check())
               @include("backend.layouts.adminHeader")
            @elseif (Auth::guard('manager')->check())
               @include("backend.layouts.managerHeader")
            @endif
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                @yield("content")

                 <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @include("backend.layouts.footer")
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- App js -->
    @yield("scripts")

</body>

</html>