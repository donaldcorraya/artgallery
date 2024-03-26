<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <title>@yield('title', 'Admin | Customer Dashboard')</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('customer_dashboard') }}" class="logo d-flex align-items-center">
                @if(isset(gs()->logo))
                    <img src="{{ asset('assets/images/setting/'.gs()->logo) }}" alt="">
                @else
                    <span>{{ __('messages.Dashboard') }}</span>
                @endif
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a href="{{ route('home') }}" class="btn btn-info btn-sm">{{ __('messages.Website') }}</a>
            <div class="ps-2">
                <select class="me-3 border-0 bg-light changeLang">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
                    <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                    <option value="nl" {{ session()->get('locale') == 'nl' ? 'selected' : '' }}>Datuch</option>
                </select>
            </div>
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
                        @if(isset($customer_img->image) && !empty($customer_img->image))
                            <img src="{{ $customer_img->image }}" alt="">
                        @else
                            <i class="fa-solid fa-user"></i>
                        @endif
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('customer_dashboard')}}">
                                <i class=" bi bi-person"></i>
                                <span>{{ __('messages.MyProfile') }}</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('customer-logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center"><i
                                        class="bi bi-box-arrow-right"></i>
                                    <span>{{ __('messages.SignOut') }}</span></button>
                            </form>
                        </li>


                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav>

    </header>

    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            @if(auth()->user()->role == 2)
            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'customer_dashboard')? '' : 'collapsed';?>" href="{{ route('customer_dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>My Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'customer_order')? '' : 'collapsed';?>" href="{{ route('customer.order.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>My Order</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'rating')? '' : 'collapsed';?>" href="{{ route('index.rating') }}">
                    <i class="bi bi-grid"></i>
                    <span>My Review</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'customer')? '' : 'collapsed';?>" href="{{ route('customer_wishlist.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>My Wishlist</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'shipping')? '' : 'collapsed';?>" href="{{ route('shipping.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Shipping Address</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (Request::segment(1) == 'billing')? '' : 'collapsed';?>" href="{{ route('billing.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Billing Address</span>
                </a>
            </li>
            @endif

        </ul>
    </aside><!-- End Sidebar-->

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
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Language setting --}}
	<script type="text/javascript">
  
		var url = "{{ route('changeLang') }}";
	  
		$(".changeLang").change(function(){
			window.location.href = url + "?lang="+ $(this).val();
		});
	  
	</script>

</body>

</html>