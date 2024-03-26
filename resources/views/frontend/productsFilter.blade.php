@extends('frontend.layout')
@section('title', 'Product | Art Gallery')
@section('content')


<style>
	.active .page-link,
	.page-link.active {
		background-color: #fa8231;
		border-color: #fa8231;
	}
</style>

<!--===========================all_products part start===================================-->
<section class="all_products">
	<div class="container">
		<div class="row">
			<aside class="col-md-3 mb-5">
				<div class="card">
					<article class="filter-group Product_categories">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">Product categories</h6>
						</header>

						@include('frontend.categoryBar')


					</article>
					<article class="filter-group">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">Architectures</h6>
						</header>
						<div class="filter-content">
							<div class="card-body" id="architecture">
								@include('frontend.FrontArchitecture')
							</div>
						</div>
					</article>
					<article class="filter-group filter_price">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">Price range </h6>
						</header>
						<div class="filter-content ">
							<div class="card-body">
								<input type="range">
								@include('frontend.shop_range_filter')	
							</div>
						</div>
					</article>
					<article class="filter-group">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">Product Sizes</h6>
						</header>
						<div class="filter-content">
							<div class="card-body">
								@include('frontend.productSize')
							</div>
						</div>
					</article>
					<article class="filter-group">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">More filters </h6>
						</header>
					</article>
				</div>
			</aside>
			<main id="products" class="col-md-9 our_best_collection Related_Products all_product_gallerys">
				<header class="border-bottom mb-4 pb-3">
					<div class="form-inline">
						<span>{{ $total_products }} {{ __('messages.Itemsfound') }} </span>
						<select class="mr-2 form-control mt-2" id="product_ordering">
							<option value="1">{{ __('messages.Latestitems') }}</option>
							<option value="4">{{ __('messages.Cheapest') }}</option>
						</select>
					</div>
				</header>
				<div class="row">
					@foreach($arr as $product)
					<div class="col-md-4">
						<figure class="card card-product-grid">
							<div class="card p-0">
								<div class="card-header">
									<a href="{{ route('shop.details', ['slug' => $product['slug']])}}"><img src="{{ asset($product['image']) }}" alt="img"></a>
								</div>
								<div class="card-body">
									<div class="rating  col-md-12 col-xl-12">
										<p>{{ $product['selling_price'] }}$</p>
										<div class="rat col-md- col-xl-">
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star-half-stroke"></i>
											<i class="fa-regular fa-star"></i>
										</div>
										<p>{{ $product['name'] }}</p>
										<p>{{ __('messages.Dimension') }} : {{ $product['size'] }}</p>
									</div>
								</div>
								<div class="woocommerce_cart">
									<a href="javascript:void(0)" onclick="addToCart({{ $product['id'] }})">
										<div class="woo_cart">
											<i class="fa-solid fa-cart-plus"></i>
										</div>
									</a>
									<div class="woo_cart">
										<i class="fa-regular fa-heart"></i>
									</div>
									<div class="woo_cart">
										<a href="{{ route('shop.details', ['slug' => $product['slug']])}}"><i class="fa-solid fa-eye"></i></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
					@endforeach
					{{ $arr->links() }}
				</div>
				
			</main>
		</div>
	</div>
</section>
<!--===========================all_products part end===================================-->
<script>
	function addToCart(id) {
		$.ajax({
			url: "{{ route('front.addToCard') }}",
			type: "post",
			dataType: 'json',
			data: {
				"_token": "{{ csrf_token() }}",
				"id": id
			},

			success: function(res) {

				if (res.status == true) {
					window.location.href = "{{ route('front.cart') }}";
				} else {
					alert(res.message);
				}

			}
		});
	}

	

	



</script>

@endsection