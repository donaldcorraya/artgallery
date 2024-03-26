<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', gs()->business_name)</title>
	<link rel="stylesheet" href="{{asset('assets/art_design/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/art_design/css/project-1.css')}}">
	<link rel="stylesheet" href="{{asset('assets/art_design/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/art_design/css/responsive.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/setting/'.$general->favicon) }}">
	<style>
		.dropdown-menu.show{width: 100%;}
		.message_block{width: auto; background: #008000de; position: absolute; right: 25px; top: 45px; z-index: 1021; padding: 10px 50px; color: #fff; border-radius: 5px;}
		.message_block{width: auto; background: #bf0c1dd9; position: absolute; right: 25px; top: 45px; z-index: 1021; padding: 10px 50px; color: #fff; border-radius: 5px;}
	</style>
</head>

<body>
	@if(Session::has('flash_message'))
    	<div class="message_block">{{ Session::get('flash_message') }}</div>
    @endif

	@if(Session::has('flash_error'))
    	<div class="message_block">{{ Session::get('flash_error') }}</div>
    @endif
	<!--===========================header part start===================================-->
	<header class="header_part">
		<div class="container superNavv">
			<div class="row">
				<div class="col-12">
					<div class="superNav border-bottom py-2 text-light">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 centerOnMobile">
									<select class="me-3 border-0 bg-light changeLang">
										<option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
										<option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
										<option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
										<option value="nl" {{ session()->get('locale') == 'nl' ? 'selected' : '' }}>Datuch</option>
									</select>
									<span
										class="d-none d-lg-inline-block d-md-inline-block d-sm-inline-block d-xs-none me-3"><strong>{{ gs()->business_email; }}</strong></span>
									<span class="me-3">
										<!-- <i class="fa-solid fa-phone me-1 text-warning"></i> -->
										<span style="font-size: 16px; color: #fa8231; font-weight: 700;"> &#9990;</span>
										<strong>{{ gs()->business_number; }}</strong>
									</span>
								</div>
								<div
									class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none d-lg-block d-md-block-d-sm-block d-xs-none text-end">
									<span class="me-3"><i class="fa-solid fa-truck text-light me-1"></i><a
											class="text-light" href="{{ route('front.checkout') }}">{{ __('messages.Checkout') }}</a></span>
					
								</div>
							</div>
						</div>
					</div>
					<nav class="navbar navbar-expand-lg bgdark sticky-top navbar-light shadow-sm ">
						<div class="container ">

							<a class="navbar-brand" href="/">
								@if(isset(gs()->logo))
								<img src="{{ asset('assets/images/setting/'.gs()->logo) }}" alt="">
								@endif
							</a>

							<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
								data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>

							<div class="mx-auto my-3 d-lg-none d-sm-block d-xs-block ">
								<div class="input-group">
									<span class="border-dark input-group-text text-white"><i
											class="fa-solid fa-magnifying-glass"></i></span>
									<input type="text" class="form-control">
									<button class="btn text-black">{{ __('messages.Search') }}</button>
								</div>
							</div>
							<div class=" collapse navbar-collapse" id="navbarNavDropdown">
								<div class="ms-auto d-none d-lg-block">
									<div class="input-group">
										<span class="border-dark input-group-text text-white"><i
												class="fa-solid fa-magnifying-glass"></i></span>
										<input name="str" type="text" class="form-control" id="header_search">
										<button type="submit" class="btn text-white">{{ __('messages.Search') }}</button>
									</div>
								</div>
								<ul class="navbar-nav ms-auto ">
									<li class="nav-item">
										<a class="nav-link mx-2 text-uppercase {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">{{ __('messages.Home') }}</a>
									</li>
					
									@each('submenu', $menulist, 'menu')
									<li class="nav-item dropdown dropdown-mega position-static">
										<a class="nav-link mx-2 text-uppercase dropdown-toggle" href="#"
											data-bs-toggle="dropdown" data-bs-auto-close="outside"> {{ __('messages.Catalog') }}</a>
										<div class="dropdown-menu shadow dropdownmega">
											<div class="mega-content px-4">
												<div class="container-fluid">
													<div class="row">
														@foreach($categories as $category)
														<div class="col-3 col-sm-3 col-md-3 py-3">
															<h5>{{ $category['name'] }}</h5>
															<div class="list-group">
																@foreach($products as $product)
																@if($category['id'] == $product['category_id'])
																<a class="list-group-item"
																	href="{{ route('shop.details', ['slug' => $product->slug])}}">{{
																	$product->name }}</a>
																@endif
																@endforeach
															</div>
														</div>

														@endforeach

													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link mx-2 text-uppercase {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">{{ __('messages.Shop') }}</a>
									</li>

									<li class="nav-item">
										<a class="nav-link mx-2 text-uppercase {{ request()->routeIs('front.blogs') ? 'active' : '' }}" href="{{ route('front.blogs') }}">{{ __('messages.Blog') }}</a>
									</li>
								</ul>
								<ul class="navbar-nav ms-auto ">
									<li class="nav-item">
										<a class="nav-link mx-2 text-uppercase" href="{{ route('wishlist.index') }}">
											<!-- <i class="fa-regular fa-heart"></i> -->
											<span style="font-size:35px;">&#9825;</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link mx-2 text-uppercase minicart-icon"
											href="javascript:void(0);">
											<!-- <i class="fa-solid fa-cart-shopping "></i> -->
											<span style="font-size:30px;">&#128722;</span>
										</a>
										<div class="cart-dropdown"id="cartDetails">
											
										</div>
									</li>

									<li class="nav-item">
										<a class="nav-link mx-2 text-uppercase my_account mt-2"
											href="javascript:void(0);">
											{{-- <span> {{ auth()->user()->name ?? 'Register' }}</span> --}}
											<span>{{ auth()->user() ? auth()->user()->name : __('messages.Register') }}</span>

										</a>
										<div class="my_account_dropdown">
											<ul>

												@if(!Auth::check())
												<li><a href="{{ route('customer-login') }}">{{ __('messages.UerLogin') }}</a></li>
												<li><a href="{{ route('customer.register') }}">{{ __('messages.UerRegister') }}</a></li>
												@else
												@if(auth()->user()->role == 2)
												<li><a href="{{ route('customer_dashboard') }}">{{ __('messages.MyAccount') }}</a></li>
												@else
												<li><a href="{{ route('dashboard') }}">{{ __('messages.MyAccount') }}</a></li>
												@endif
												<li>
													<form action="{{ route('logout') }}" method="POST">
														@csrf
														<button type="submit"
															class="btn btn-sm btn-block">{{ __('messages.Logout') }}</button>
													</form>
												</li>
												@endif

											</ul>
										</div>
									</li>
								</ul>
							</div>
							<div class="search_content" style="padding-top: 10px"></div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!--===========================header part end===================================-->
	@yield('content')
	<!--===========================footer part start===================================-->
	<footer class="footer_part pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 contact_info">
					<div class="">
						<h5 class="mb-4">{{ __('messages.Contactus') }}</h5>
						<div class="address d-flex gap-3">
							<i class="fa-solid fa-location-dot"></i>
							<p>{{ gs()->business_address; }}</p>
						</div>
						<div class="phone d-flex gap-3">
							<i class="fa-solid fa-phone-volume"></i>
							<p>{{ gs()->business_number; }}</p>
						</div>
						<div class="email d-flex gap-3">
							<i class="fa-solid fa-envelopes-bulk"></i>
							<p>{{ gs()->business_email; }}</p>
						</div>
					</div>
					<div class="subscribe">
						<h5>{{ __('messages.Subscribe') }}</h5>
						<p>{{ __('messages.SubscribeContent') }}</p>
						<form action="{{ route('subscribe_email') }}" method="post">
							<input type="email" class="form-controll mb-2" style="height: 30px; padding: 5px" name="subscribe_email">	
							@csrf						
							<button class="btn btn-sm btn-warning  mb-2" type="submit">{{ __('messages.Submit') }}</button>
							<b><small class="text-danger">{{ $errors->first('subscribe_email') }}</small></b>
						</form>
					</div>
				</div>
				<div class="col-sm-3 contact_info">
					<div class="about_info ">
						<h5 class="mb-4">{{ __('messages.Important') }}</h5>
						@foreach($footer_menus as $menu_link)	
						<a href="{{ url('front-pages/'.$menu_link->url) }}">{{ ucfirst($menu_link->name) }}</a> <br>
						@endforeach				
					</div>
				</div>
				<div class="col-sm-3 contact_info">
					<div class="about_info ">
						<h5 class="mb-4">{{ __('messages.ProductCategories') }}</h5>
						@foreach($categories as $category)	
						<a href="{{ url('product-by-category/'.$category->id) }}">{{ ucfirst($category->name) }}</a> <br>
						@endforeach		
					</div>
				</div>
				<div class="col-sm-3 ">
					<div class="about_info ">
						<h5 class="mb-4">{{ __('messages.Download') }}</h5>
						<img src="{{ asset('assets/images/app.png') }}" class="img-fluid" alt="Image 2">
					</div>
				</div>
			</div>
			<div class="row text-center pt-3 mt-5 footer_bottom">
				<div class="col-12">
					<p>{{ __('messages.Copyright') }}</p>
				</div>
			</div>
		</div>
	</footer>
	<!--===========================footer part end===================================-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="{{asset('assets/art_design/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/art_design/js/main.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
		$(document).ready(function () {
			getCartDetails();
			// Remove item functionality using jQuery
			$('.remove-item').click(function (event) {
				event.preventDefault();
				const itemId = $(this).data('item-id');
				// Assuming you want to remove the entire row when the trash icon is clicked
				const itemRow = $(this).closest('.row');
				if (itemRow) {
					itemRow.remove();
					// Perform additional actions like updating the total price, if needed
				}
			});


			$('#header_search').on('keyup', function () {
				var str_length = $('#header_search').val().length;

				if (str_length >= 3) {

					var str = $('#header_search').val();

					$.ajax({
						type: 'GET',
						url: '{{ route("front.search_ajax") }}',
						data: {
							'str': str
						},
						dataType: 'html',
						success: function (data) {
							if (data) {
								$('.search_content').empty();
								$('.search_content').append(data);
								$('.search_content').show();
							}
						}
					});
				}

				if (str_length <= 0) {
					$('.search_content').hide();
					$('.search_content').empty();
				}
			});

		});

	</script>


	<!-- For blog page code -->
	<script>

		$('#blogCatSearch').on('keyup', function () {
		var str_length = $('#blogCatSearch').val().length;

			if (str_length >= 3) {

				var str = $('#blogCatSearch').val();

				$.ajax({
					type: 'GET',
					url: '{{ route("front.search_blogCat") }}',
					data: {
						'str': str
					},
					dataType: 'html',
					success: function (data) {
						if (data) {
							$('.blog_search_section').empty();
							$('.blog_search_section').append(data);
							$('.blog_search_section').show();
						}
					}
				});
			}

			if (str_length <= 0) {
				$('.blog_search_section').hide();
				$('.blog_search_section').empty();
			}
		});

	</script>
	<!-- For blog page code end -->


	<!-- For shop page code -->
	<script>
		$('input[type=range]').on('input', function () {
			var val = $("input[type=range]").val();
			val =val*100;
			$("#max").val(val);
		});
	</script>

	


	<script>
	$('#product_ordering').on('change', function(){

		$('.architecture').prop('checked', false);
		var order_type = this.value;

		$('.pagination').remove();
		$('.cat_ul li').removeClass('active');

		$.ajax({
			type: 'GET',
			url: "{{ route('front.architect_id_ajax') }}",
			dataType: 'html',
			data : {
				"_token": "{{ csrf_token() }}",
				'type' : 3,
				'order_type' : order_type
			},
			success: function (data) {
				if(data){
					$('#products').empty();
					$('#products').html(data);
				}
			},
		});
	});


	$(".architecture").on('click' ,function() {
		
		const architecture_id = [];
		var sList = "";
		$('.architecture').each(function () {

			if(this.checked){
				architecture_id.push($(this).val());
			}
			
		});

		

		if(architecture_id != ''){
			
			$.ajax({
                type: 'GET',
                url: "{{ route('front.architect_id_ajax') }}",
				dataType: 'html',
                data : {
					"_token": "{{ csrf_token() }}",
                    'id' : JSON.stringify(architecture_id),
					'type' : 1
                },
                success: function (data) {
					if(data){
						$('#products').empty();
						$('#products').html(data);
					}
                },
			});
		}else{
			
		}

	});


	$("#range_filter").on('submit', function(e){
		e.preventDefault();
		$('.architecture').prop('checked', false);
		var min = $("#range_filter [name='min']").val();
		var max = $("#range_filter [name='max']").val();
		

		if(max != '' && min != ''){

			$.ajax({
                type: 'GET',
                url: "{{ route('front.architect_id_ajax') }}",
				dataType: 'html',
                data : {
					"_token": "{{ csrf_token() }}",
					'min' : min,
					'max' : max,
					'type' : 4
                },
                success: function (data) {
					if(data){
						$('#products').empty();
						$('#products').html(data);
					}
                },
			});
			
		}
	});
	
	

	$(document).on("click", ".addToWish", function (e) {
        e.preventDefault();
        
        var url = $(this).attr('href');
        
        $.ajax({
            url: url,
            type: "GET",
            success: function (res) {
                if(res.status === true){
                    toastr.success('Item is Added in the wishlist');
                }else{
                    toastr.error('Please log in to perform this action.');
                }
            },
            error: function () {
                toastr.error('An error occurred. Please try again later.');
            }
        });
    });
	</script>

	

	<script type="text/javascript">

	$('.category_item').on('click', function(){

		$('.architecture').prop('checked', false);

		const architecture_id = [];

		architecture_id.push($(this).attr('data-index'));

		$('.cat_ul li').removeClass('active');
		$(this).parent().addClass('active');


		$.ajax({
			type: 'GET',
			url: "{{ route('front.architect_id_ajax') }}",
			dataType: 'html',
			data : {
				"_token": "{{ csrf_token() }}",
				'id' : JSON.stringify(architecture_id),
				'page' : 1,
				'type' : 2,
				
			},
			success: function (data) {
				if(data){
					$('#products').empty();
					$('#products').html(data);
				}
			},
		});

	}); 

	</script>
	@stack('script')

	<script>
	function addToCart(id){
			$.ajax({
				url : "{{ route('front.addToCard') }}",
				type : "post",
				dataType : 'json',
				data : {
					"_token": "{{ csrf_token() }}",
					"id" : id
				},

				success: function(res){

					if(res.status == true){
						toastr.success('Item added to cart successfully!');
						getCartDetails();
					}else{
						alert(res.message);
					}
					
				}
			});
		}
	
	
		function getCartDetails(id){
			$.ajax({
				url : "{{ route('get-cart-details') }}",
				type : "GET",
				dataType : 'html',
				success: function(res){
					$('#cartDetails').html(res);
				}
			});
		}
	
	
		$(document).on('click', '.removeBtn', function(e){
		e.preventDefault();
        var href = $(this).attr('href');
		$.ajax({
				url : href,
				type : "GET",
				dataType : 'json',
				success: function(res){
					toastr.success('Item removed successfully!');
					getCartDetails();
				}
			});
	});

	function addToCartWithQty(id) {
		var qty = parseInt($("#result").text());

		$.ajax({
			url: "{{ route('front.addToCartWithQty') }}",
			type: "post",
			dataType: 'json',
			data: {
				"_token": "{{ csrf_token() }}",
				"id": id,
				'qty': qty
			},

			success: function (res) {
				if(res.status == true){
					toastr.success('Item added to cart successfully!');
					getCartDetails();
				}else{
					alert(res.message);
				}

			}
		});
	}
	</script>
	
	{{-- Language setting --}}
	<script type="text/javascript">
  
		var url = "{{ route('changeLang') }}";
	  
		$(".changeLang").change(function(){
			window.location.href = url + "?lang="+ $(this).val();
		});

		$(function() {			
			setTimeout(function() {
				$(".message_block").fadeOut(2000);
			}, 2000);
		});
	  
	</script>

	<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
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

</body>

</html>