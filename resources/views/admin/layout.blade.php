<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>@yield('title', 'Admin | Dashboard')</title>

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
    <link href="{{asset('assets/css/print.min.css')}}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            @if(isset(gs()->logo))
            <img src="{{ asset('assets/images/setting/'.gs()->logo) }}" alt="">
            @endif
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a href="{{ route('home') }}" class="btn btn-info btn-sm">Website</a>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                       
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href=">
                                <i class=" bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('admin-logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center"><i
                                        class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span></button>
                            </form>

                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav>

    </header>
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                @if(auth()->user()->role == 1)
                <a class="nav-link <?= (Request::segment(1) == 'dashboard')? '' : 'collapsed';?>" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
                @else 
                <a class="nav-link <?= (Request::segment(1) == 'customer_dashboard')? '' : 'collapsed';?>" href="/customer_dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(1) == 'architect') ? '' : 'collapsed' }}"
                    data-bs-target="#architect-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Architect</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="architect-nav"
                    class="nav-content {{ (Request::segment(1) == 'architect') ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('architect.index') }}"
                            class="{{ (Request::segment(1) == 'architect') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>List</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(1) == 'product' || Request::segment(1) == 'category') ? '' : 'collapsed' }}"
                    data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="product-nav" class="nav-content {{ (Request::segment(1) == 'product' || Request::segment(1) == 'category') ? 'show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ route('category.index') }}"
                            class="{{ (Request::segment(1) == 'category') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Category List</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('product.index') }}"
                            class="{{ (Request::segment(1) == 'product') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Product List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'ratingAll' || Request::segment(1) == 'ratingPending' || Request::segment(1) == 'ratingPublishedDetails' || Request::segment(1) == 'ratingHiddenDetails') ? '' : 'collapsed';?>"
                    data-bs-target="#rating-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Product Rating</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="rating-nav"
                    class="nav-content <?= (Request::segment(1) == 'ratingAll' || Request::segment(1) == 'ratingPending' || Request::segment(1) == 'ratingPublishedDetails' || Request::segment(1) == 'ratingHiddenDetails') ? 'show' : 'collapse';?>"
                    data-bs-parent="#rating-nav">

                    <li><a href="{{ route('rate.all') }}"
                            class="{{ (Request::segment(1) == 'ratingAll') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>All</span></a></li>

                    <li><a href="{{ route('rate.pending') }}"
                            class="{{ (Request::segment(1) == 'ratingPending') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Pending</span></a></li>
                    <li><a href="{{ route('rate.publishedDetails') }}"
                            class="{{ (Request::segment(1) == 'ratingPublishedDetails') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Published</span></a></li>
                    <li><a href="{{ route('rate.hiddenDetails') }}"
                            class="{{ (Request::segment(1) == 'ratingHiddenDetails') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Hidden</span></a></li>
                </ul>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(1) == 'coupon') ? '' : 'collapsed' }}"
                    data-bs-target="#coupon-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Discount Coupon</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="coupon-nav" class="nav-content {{ (Request::segment(1) == 'coupon') ? 'show' : 'collapse' }}"
                    data-bs-parent="#coupon-nav">
                    <li>
                        <a href="{{ route('coupon.index') }}"
                            class="{{ (Request::segment(1) == 'coupon') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Promo code list </span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'adminCustomerOrders' || Request::segment(1) == 'orderPending' || Request::segment(1) == 'orderAccepted' || Request::segment(1) == 'orderDelivered' || Request::segment(1) == 'orderConfirmed' || Request::segment(1) == 'orderCancelled' ) ? '' : 'collapsed';?>"
                    data-bs-target="#customerOder-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Order List </span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="customerOder-nav"
                    class="nav-content <?= (Request::segment(1) == 'adminCustomerOrders' || Request::segment(1) == 'orderPending' || Request::segment(1) == 'orderAccepted' || Request::segment(1) == 'orderDelivered' || Request::segment(1) == 'orderConfirmed' || Request::segment(1) == 'orderCancelled') ? 'show' : 'collapse';?>"
                    data-bs-parent="#sidebar-nav">

                    <li><a href="{{route('front.adminCustomerOrders')}}"
                            class="{{ (Request::segment(1) == 'adminCustomerOrders') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>All</span></a></li>
                    <li><a href="{{route('front.adminCustomerOrders.pending')}}"
                            class="{{ (Request::segment(1) == 'orderPending') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Pending</span></a></li>
                    <li><a href="{{route('front.adminCustomerOrders.accepted')}}"
                            class="{{ (Request::segment(1) == 'orderAccepted') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Accepted</span></a></li>
                    <li><a href="{{route('front.adminCustomerOrders.delivered')}}"
                            class="{{ (Request::segment(1) == 'orderDelivered') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Delivered</span></a></li>
                    <li><a href="{{route('front.adminCustomerOrders.confirmed')}}"
                            class="{{ (Request::segment(1) == 'orderConfirmed') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Confirmed</span></a></li>
                    <li><a href="{{route('front.adminCustomerOrders.cancelled')}}"
                            class="{{ (Request::segment(1) == 'orderCancelled') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Canceled</span></a></li>
                </ul>
            </li>

            


            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'slider_banner' || Request::segment(1) == 'top_banner' || Request::segment(1) == 'main_banner' || Request::segment(1) == 'bottom_banner' || Request::segment(1) == 'logo' || Request::segment(1) == 'favicon' || Request::segment(1) == 'brand') ? '' : 'collapsed';?>"
                    data-bs-target="#banner-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Home Page Banner</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>

                <ul id="banner-nav"
                    class="nav-content <?= (Request::segment(1) == 'slider_banner' || Request::segment(1) == 'top_banner' || Request::segment(1) == 'main_banner' || Request::segment(1) == 'bottom_banner' || Request::segment(1) == 'logo' || Request::segment(1) == 'favicon' || Request::segment(1) == 'brand') ? 'show' : 'collapse';?>"
                    data-bs-parent="#sidebar-nav">

                    <li><a href="{{ route('slider_banner.index') }}"
                            class="{{ (Request::segment(1) == 'slider_banner') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Slider Banner</span></a></li>
                    <li><a href="{{ route('top_banner.index') }}"
                            class="{{ (Request::segment(1) == 'top_banner') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Top Banner</span></a></li>
                    <li><a href="{{ route('main_banner.index') }}"
                            class="{{ (Request::segment(1) == 'main_banner') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Main Banner</span></a></li>
                    <li><a href="{{ route('bottom_banner.index') }}"
                            class="{{ (Request::segment(1) == 'bottom_banner') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Bottom Banner</span></a></li>
                    <li><a href="{{ route('brand.index') }}"
                            class="{{ (Request::segment(1) == 'brand') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Brand Name</span></a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(1) == 'blog' || Request::segment(1) == 'blog_category' || Request::segment(1) == 'blog-comments') ? '' : 'collapsed' }}"
                    data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Blog</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="blog-nav"
                    class="nav-content {{ (Request::segment(1) == 'blog' || Request::segment(1) == 'blog_category' || Request::segment(1) == 'blog-comments') ? 'show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('blog_category.index') }}"
                            class="{{ (Request::segment(1) == 'blog_category') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Blog Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}"
                            class="{{ (Request::segment(1) == 'blog') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Blog Post </span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('blog-comments') }}"
                            class="{{ (Request::segment(1) == 'blog-comments') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Blog Comments </span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            

            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(1) == 'sales' || Request::segment(1) == 'order' || Request::segment(1) == 'wishlist' || Request::segment(1) == 'delivery') ? '' : 'collapsed' }}"
                    data-bs-target="#report" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Report</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="report"
                    class="nav-content {{ (Request::segment(1) == 'sales' || Request::segment(1) == 'order' || Request::segment(2) == 'wishlist' || Request::segment(1) == 'delivery') ? 'show' : 'collapse' }}"
                    data-bs-parent="#report">
                    <li><a href="{{ route('sales.report') }}"
                            class="{{ (Request::segment(1) == 'sales') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Sales Report</span></a></li>
                    <li><a href="{{ route('order.report') }}"
                            class="{{ (Request::segment(1) == 'order') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Order Report</span></a></li>
                    <li><a href="{{ route('wishlist.report') }}"
                            class="{{ (Request::segment(2) == 'wishlist') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Wishlist Report</span></a></li>
                    <li><a href="{{ route('delivery.report') }}"
                            class="{{ (Request::segment(1) == 'delivery') ? 'active' : '' }}"><i
                                class="bi bi-circle"></i><span>Delivery Report</span></a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'pages' || Request::segment(1) == 'menus') ? '' : 'collapsed';?>" 
                    data-bs-target="#front-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-globe-central-south-asia"></i><span>Front Web Setting </span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="front-nav" class="nav-content <?= (Request::segment(1) == 'pages' || Request::segment(1) == 'menus') ? 'show' : 'collapse';?>" 
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('pages.index') }}" class="{{ (Request::segment(1) == 'pages' && !Request::segment(2)) ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Page List </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('menus.index') }}" class="{{ (Request::segment(1) == 'menus') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Menu List </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['setting', 'email-setting', 'database-backup', 'get-log-data', 'application-cache-clear', 'seo-setting', 'footer-setting', 'tax']) ? '' : 'collapsed' }}" 
                    data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#" 
                    aria-expanded="{{ request()->routeIs(['setting', 'email-setting', 'database-backup', 'get-log-data', 'application-cache-clear', 'seo-setting']) ? 'true' : 'false' }}">
                    <i class="bi bi-gear-fill"></i><span> Application Setting </span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="setting-nav" class="nav-content {{ request()->routeIs(['setting', 'email-setting', 'database-backup', 'get-log-data', 'application-cache-clear', 'seo-setting', 'footer-setting', 'tax']) ? '' : 'collapse' }} " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('setting') }}" class="{{ request()->routeIs('setting') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>General Setting </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('email-setting') }}" class="{{ request()->routeIs('email-setting') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Email Setting </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seo-setting') }}" class="{{ request()->routeIs('seo-setting') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>SEO Setting </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('application-cache-clear') }}" class="{{ request()->routeIs('application-cache-clear') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Application Cache Clear </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('tax') }}" class="{{ request()->routeIs('tax') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Vat Settting</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

    </aside>

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>ArtGallery</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="">SeoExpate</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/print.min.js')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
  @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>

<script>
    // Hide flash messages after 5 seconds
    $(document).ready(function(){
        $('#flash_message, #del_message').delay(3000).fadeOut();
    });
</script>

    @stack('script')
</body>

</html>