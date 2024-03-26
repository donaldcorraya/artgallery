@extends('frontend.layout')
@section('title', 'Product Details | ' . gs()->business_name)
@section('content')

<style>
	button.rating-btn:focus {
		border: none;
	}

	.rating {
		float: left;
	}

	.rating:not(:checked)>input {
		position: absolute;
		top: -9999px;
		clip: rect(0, 0, 0, 0);
	}

	.rating:not(:checked)>label {
		float: right;
		width: 1em;
		padding: 0 .1em;
		overflow: hidden;
		white-space: nowrap;
		cursor: pointer;
		font-size: 200%;
		line-height: 1.2;
		color: #ffc107;
	}

	.rating:not(:checked)>label:before {
		content: '★ ';
	}

	.rating>input:checked~label {
		color: #f70;
	}

	.rating:not(:checked)>label:hover,
	.rating:not(:checked)>label:hover~label {
		color: gold;
	}

	.rating>input:checked+label:hover,
	.rating>input:checked+label:hover~label,
	.rating>input:checked~label:hover,
	.rating>input:checked~label:hover~label,
	.rating>label:hover~input:checked~label {
		color: #ea0;
	}

	.rating>label:active {
		position: relative;
		top: 2px;
		left: 2px;
	}

	.clearfix:before,
	.clearfix:after {
		content: " ";
		display: table;
	}

	.clearfix:after {
		clear: both;
	}

	#status,
	.rating-btn {
		margin: 20px 0;
	}
</style>

<!--===========================product_details part start===================================-->
<section class="product_details">
	<div class="container">

		@if(isset($other_images))
		<div class="lightbox" id="lightbox">
			<div class="lightbox-content">
				<span class="close cursor" onclick="closeModal()">&times;</span>

				@foreach($other_images as $other_img)
				<div class="mySlides">
					<img src="{{asset($other_img)}}">
				</div>
				@endforeach

				<a href="#" class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a href="#" class="next" onclick="plusSlides(1)">&#10095;</a>
			</div>
			<div class="thumbnails cursor">
				@foreach($other_images as $other_img)
				<img src="{{asset($other_img)}}" alt="" onclick="openModal();currentSlide(1)">
				@endforeach
			</div>
		</div>
		@endif
		<div class="row">
			<div class="imgs-col col-md-6">
				<div class="main-img">
					<a href="#" class="prev2" onclick="plusSlides2(-1)">&#10094;</a>
					<div class="mySlides2">
						<img src="{{ asset($product['image']) }}">
					</div>
					<a href="#" class="next2" onclick="plusSlides2(1)">&#10095;</a>
				</div>
				@if(isset($other_images))
				<div class="thumbnails cursor">
					@foreach($other_images as $other_img)
					<img src="{{asset($other_img)}}" alt="" class="" onclick="openModal();currentSlide(1)">
					@endforeach
				</div>
				@endif
			</div>
			<div class="text-col col-md-6">
				<h2>{{ $product['name'] }}</h2>
				<p>{{ $product['short_description'] }}</p>
				@php
				$averageRating = getRatings($product->id);
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


				<div class="d-flex gap-5">
					<span>{{ __('messages.SKU') }} : </span>
					<span> {{ $product['product_code'] }}</span>
				</div>
				<div class="d-flex gap-5">
					<span>{{ __('messages.Category') }} : </span>
					<span> {{ $product->category->name }}</span>
				</div>
				<div class="d-flex gap-5">
					<span>{{ __('messages.Architect') }} : </span>
					<span> {{ $product->architect->name }}</span>
				</div>
				<span id="price">
					<h2>$<span id="amount">{{ $product['selling_price'] }}</span></h2>
					@if($percentage < 0)
					<small>{{ $percentage }}%</small>
					@endif
				</span>
				@if($percentage < 0)
				<span id="old-price">${{ $product['regular_price'] }}</span>
				@endif
				<p class="text-success">{{ $product['stock_amount'] }} {{ __('messages.instock') }}</p>
				<div class="options">
					<button><img src="{{asset('assets/art_design/images/icon-minus.svg')}}" alt=""
							onclick="minus()"></button>
					<button id="result">1</button>
					<button onclick="plus()"><img src="{{asset('assets/art_design/images/icon-plus.svg')}}"
							alt=""></button>
					<button id="addToCart" onclick="addToCartWithQty('{{ $product->id }}')"><i
							class="fa-solid fa-cart-plus"></i>{{ __('messages.AddtoCart') }}</button>

					<br>
					<button href="{{ route('wishlist.store', ['id' => $product->id]) }}" type="button" class="addToWish"  data-product-id="{{ $product->id }}">
						<i class="fa-regular fa-heart"></i> {{ __('messages.AddtoWishlist') }}
					</button>

					
				</div>
			</div>
		</div>
	</div>
</section>
<!--===========================product_details part end===================================-->

<!--===========================product_description part start===================================-->
<section class="product_description ">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div style=" padding: 10px; margin: 10px">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="personal-tab" data-bs-toggle="tab"
								data-bs-target="#personal" type="button" role="tab" aria-controls="personal"
								aria-selected="true">
								{{ __('messages.Description') }}</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="employment-tab" data-bs-toggle="tab"
								data-bs-target="#employment" type="button" role="tab" aria-controls="employment"
								aria-selected="false">
								{{ __('messages.Additionalinformation') }}</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews"
								type="button" role="tab" aria-controls="Reviews" aria-selected="false">
								 {{ __('messages.Reviews') }}({{ (count($ratings) > 0)? count($ratings) : 0 }})</button>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="personal" role="tabpanel"
							aria-labelledby="personal-tab">
							{!! $product['long_description'] !!}
						</div>
						<div class="tab-pane fade" id="employment" role="tabpanel" aria-labelledby="employment-tab">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th>{{ __('messages.Weight') }} </th>
										<td>{{ $product['weight'] }}</td>
									</tr>
									<tr>
										<th>{{ __('messages.Dimensions') }}</th>
										<td>{{ $product['size'] }}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
							@php 
							$checkOrder = getOrderbyProduct($product->id);
							@endphp 
							@if($checkOrder)
							<form action="{{ route('submit.rating') }}" onsubmit="return validateInput()" method="POST">
								@csrf
								<input type="hidden" name="product_id" value="{{ $product->id }}">

								<div class="form-group">
									<label for="rating">{{ __('messages.Rating') }}:</label>
									<input type="number" id="numberInput" class="form-control" name="rating" min="1"
										max="5" required>
								</div>

								<div class="form-group">
									<label for="review">{{ __('messages.Review') }}:</label>
									<textarea class="form-control" name="review" rows="4" required></textarea>
								</div>
								<br>
								<button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
							</form>
							@endif 
							<br>

							@foreach($ratings as $rate)
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th><img src="{{asset('assets/art_design/images/images.png')}}" width="50px"
												alt="img"></th>
										<td>
											<div class="rat col-md- col-xl-">
												<?php for ($x = 1; $x <= $rate->review_count; $x++) { ?>
												<i class="fa-solid fa-star"></i>
												<?php } 
												 
												 $counter = 5;

												 if($rate->review_count <= $counter){
												
													$regular_star = $counter-$rate->review_count;
													
													if($regular_star > 0){
														for ($x = 1; $x <= $regular_star; $x++) {
															echo "<i class='fa-regular fa-star'></i>";
														}
													}
												}
												?>
											</div>
											<p>{{ __('messages.admin') }} - {{ diffForHumans($rate->created_at) }}</p>
											<p>{{ $rate->comment }}</p>
										</td>
									</tr>
								</tbody>
							</table>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--===========================product_description part end===================================-->

<!--===========================Our Best Collection part start===================================-->

<section class="our_best_collection Related_Products">
	<div class="container">
		<div class="row mt-5" id="filter-buttons">
			<h2>{{ __('messages.RelatedProducts') }}</h2>
		</div>
		<hr>
		<div class="row px-2 mt-4 gap-3" id="filterable-cards">
			@foreach($related_product as $relt_product)
			@if ($product['id'] != $relt_product['id'])
			<div class="card p-0" data-name="Coffee">
				<div class="card-header">
					<a href="{{ route('shop.details', ['slug' => $relt_product['slug']])}}"><img
							src="{{ asset($relt_product['image']) }}" alt="img"></a>
				</div>
				<div class="card-body">
					<div class="rating  col-md-12 col-xl-12">
						<p>{{ $relt_product['selling_price'] }}</p>
						@php
							$averageRating = getRatings($relt_product['id']);
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

						<p>{{ $relt_product['name'] }}</p>
						<p>{{ __('messages.Dimension') }} : {{ $relt_product['size'] }}</p>
					</div>
				</div>
				<div class="woocommerce_cart">
					<a href="javascript:void(0)" onclick="addToCart({{ $product['id'] }})">
						<div class="woo_cart">
							<i class="fa-solid fa-cart-plus"></i>
						</div>
					</a>
					<a href="{{route('wishlist.store', $product['id'])}}" class="addToWish">
						<div class="woo_cart">
							<i class="fa-regular fa-heart"></i>
						</div>
					</a>
					<div class="woo_cart">
						<a href="{{ route('shop.details', ['slug' => $product['slug']])}}"><i class="fa-solid fa-eye"></i></a>
					</div>
				</div>
			</div>
			@endif
			@endforeach
		</div>
	</div>
</section>

@endsection

@push('script')

<script>
	//this function define the product_details page popup modal
	function openModal() {
		document.getElementById("lightbox").style.display = "flex";
	}

	function closeModal() {
		document.getElementById("lightbox").style.display = "none";
	}
	//this function define the product_details page popup product-slider
	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	function showSlides(n) {
		var i;
		var slides = document.getElementsByClassName("mySlides");
		if (n > slides.length) {
			slideIndex = 1
		}
		if (n < 1) {
			slideIndex = slides.length
		}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}

		slides[slideIndex - 1].style.display = "flex";
	}
	//this function define the product_details page product-slider
	var slideIndex2 = 1;
	showSlides2(slideIndex2);

	function plusSlides2(n) {
		showSlides2(slideIndex2 += n);
	}

	function currentSlide2(n) {
		showSlides2(slideIndex2 = n);
	}

	function showSlides2(n) {
		var i;
		var slides = document.getElementsByClassName("mySlides2");
		if (n > slides.length) {
			slideIndex2 = 1
		}
		if (n < 1) {
			slideIndex2 = slides.length
		}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}

		slides[slideIndex2 - 1].style.display = "flex";
	}
</script>

<script>
	function validateInput() {
		var numberInput = document.getElementById("numberInput").value;
		if (numberInput < 1 || numberInput > 5) {
			alert("Please enter a number between 1 and 5.");
			return false;
		}
		return true;
	}

</script>
@endpush