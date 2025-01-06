<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{route('dashboard')}}" class="logo text-center logo-light">
        <span class="logo-lg">

            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="65"> <b>School Meal Program</b>
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="75">

        </span>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar="">
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title side-nav-item">Main Menu</li>
            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="uil-chart"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ url('detail-report') }}" class="side-nav-link">
                    <i class="uil-chart"></i>
                    <span>Listing Data</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('get-school-gallery') }}" class="side-nav-link">
                    <i class="uil-chart"></i>
                    <span>Gallery</span>
                </a>
            </li>
            <!-- <li class="side-nav-item">
                <a href="consumption.html"  class="side-nav-link">
                    <i class="uil-chart"></i>
                    <span> Consumption Details</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="listing.html"  class="side-nav-link">
                    <i class="uil-chart"></i>
                    <span> Listing </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="gallery.html"  class="side-nav-link">
                    <i class="uil-table"></i>
                    <span> Gallery </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="index.html"  class="side-nav-link">
                    <i class="mdi mdi-logout"></i>
                    <span> Login </span>
                </a>
            </li> -->

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->