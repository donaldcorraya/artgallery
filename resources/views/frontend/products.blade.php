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
							<h6 class="title">{{ __('messages.ProductCategories') }}</h6>
						</header>
{{-- 
						@include('frontend.categoryBar') --}}

						<div class="filter-content">
							<div class="card-body">
								<form class="pb-3">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="{{ __('messages.Search') }}" id="shopCat">
										<div class="blog_search_section" style="width: max-content; height: auto; position: absolute; top: 43px;border-radius: 4px; display: block"></div>
										<div class="input-group-append">
											<button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</form>
								<ul class="navbar-nav ms-auto cat_ul">
									@foreach($categoryBar as $cat)                
										<li><a class="category_item" data-index="{{ $cat['id'] }}" href="javascript:void(0)">{{ $cat['name'] }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>


					</article>
					<article class="filter-group">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">{{ __('messages.Architectures') }}</h6>
						</header>
						<div class="filter-content">
							<div class="card-body" id="architecture">
								{{-- @include('frontend.FrontArchitecture') --}}
								@foreach($frontArchitecture as $archi)
								<label class="d-flex justify-content-between">
									<div>
										<input type="checkbox" class="architecture" value="{{ $archi->id }}">
										<span>{{ $archi->name }}</span>
									</div>
									<div><span>{{ $archi->total }}</span></div>
								</label>
								@endforeach
							</div>
						</div>
					</article>
					<article class="filter-group filter_price">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">{{ __('messages.Pricerange') }}</h6>
						</header>
						<div class="filter-content">
							<div class="card-body">
								<input type="range">
								{{-- @include('frontend.shop_range_filter') --}}
								<form id="range_filter" method="GET">
									<div class="form-row d-flex mb-4 gap-2">
										<div class="form-group col-md-6">
											<label>{{ __('messages.Min') }}</label>
											<input name="min" class="form-control" value="100" placeholder="$0" type="number">
											<input name="page" class="form-control" value="1" type="hidden">
										</div>
										<div class="form-group text-right col-md-6">
											<label>{{ __('messages.Max') }}</label>
											<input name="max" id="max" class="form-control" min="100" max="50000" value="<?= isset($_GET['max']) ? $_GET['max'] : '';; ?>" placeholder="$1,0000" type="number">
										</div>
									</div>
									<button type="submit" class="btn">{{ __('messages.Filter') }}</button>
								</form>
							</div>
						</div>
					</article>
					{{-- <article class="filter-group">
						<header class="card-header">
							<i class="icon-control fa fa-chevron-down"></i>
							<h6 class="title">{{ __('messages.ProductSizes') }}</h6>
						</header>
						<div class="filter-content">
							<div class="card-body">
								@include('frontend.productSize')
							</div>
						</div>
					</article> --}}
				</div>
			</aside>
			<main id="products" class="col-md-9 our_best_collection Related_Products all_product_gallerys">
				<header class="border-bottom mb-4 pb-3">
					<div class="form-inline">
						<span id="total_products">{{ (isset($total_products)? $total_products : '') }}</span>  {{ __('messages.Itemsfound') }}
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

@endsection

@push('script')
<script>

    $('#shopCat').on('keyup', function () {
    var str_length = $('#shopCat').val().length;

        if (str_length >= 3) {

            var str = $('#shopCat').val();

            $.ajax({
                type: 'GET',
                url: '{{ route("front.search_shopCat") }}',
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

@endpush