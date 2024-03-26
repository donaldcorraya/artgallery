@extends('frontend.layout')
@section('title', 'Cart | Art Gallery')
@section('content')
<style>
	.active .page-link,
	.page-link.active {
		background-color: #fa8231;
		border-color: #fa8231;
	}
</style>

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
									<input type="range" >
									@include('frontend.shop_range_filter')
								</div>
							</div> 
						</article> 
						<article class="filter-group">
							<header class="card-header">
								<i class="icon-control fa fa-chevron-down"></i>
								<h6 class="title">Product Sizes </h6>
							</header>
							<div class="filter-content">
								<div class="card-body">
								  	<label class=" d-block">
								    	<input type="checkbox">
								    	<span> XS </span>
								  	</label>
								  	<label class="d-block">
								    	<input type="checkbox">
								    	<span> SM </span>
								  	</label>
								  	<label class="d-block">
								    	<input type="checkbox">
								    	<span> LG </span>
								  	</label>
								  	<label class="d-block">
								    	<input type="checkbox">
								    	<span> XXL </span>
								  	</label>
								  	<label class="d-block">
								    	<input type="checkbox">
								    	<span> XL </span>
								  	</label>
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
				<main class="col-md-9 our_best_collection Related_Products all_product_gallerys">
					<header class="border-bottom mb-4 pb-3">
						<div class="form-inline">
							<span>{{ $total_products }} Items found </span>
							<select class="mr-2 form-control mt-2">
								<option>Latest items</option>
								<option>Trending</option>
								<option>Most Popular</option>
								<option>Cheapest</option>
							</select>
						</div>
					</header>
					<div class="row" id="products">
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
									    @php
											$averageRating = getRatings($product['id']);
										@endphp
										<div class="rat col-md- col-xl-">
											<div class="average-rating">
												@for ($i = 1; $i <= 5; $i++) @if ($i <=$averageRating) <i class="fas fa-star"></i>
													<!-- Full star -->
													@else
													<i class="far fa-star"></i> <!-- Empty star -->
													@endif
													@endfor
													<span>({{ $averageRating }})</span>
											</div>
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
						          		<a href="product_details_page.html"><i class="fa-solid fa-eye"></i></a>
						          	</div>
						          </div>
						        </div>
							</figure>
						</div>  
						@endforeach
					</div> 
					{{ $arr->links() }}	
				</main>
			</div>
		</div>
	</section>

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