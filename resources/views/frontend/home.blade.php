@extends('frontend.layout')
@section('title', 'Home Page | Art Gallery')
@section('content')
    <section class="top-slider">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <!-- Carousel Items -->
                            @foreach ($sliderBanner as $key => $item)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="images/{{ $item->slider_banner_img }}" class="d-block w-100" alt="img" style="height: 400px;"> <!-- Adjust the height as needed -->
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $item->slider_banner_title }}</h5>
                                        <p>{{ $item->slider_banner_tagline }}</p>
                                        <a href="{{ route('shop')}}"><button type="button" class="btn btn">Shop Now</button></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--===========================slider part end===================================-->

    <!--===========================banner part start===================================-->
    <section class="banner">
        <div class="container">
            <div class="row bannerpart">
                @foreach ($topBanner as $item)
                    <div class="col-md-6 pt-3 bannerpartimg">
                        <div class="bannerimage">
                            <a href="{{ route('shop')}}"><img src="images/{{ $item->top_banner_img }}" alt="img"
                                    class="d-block w-100"></a>
                            <div class="bannerimage_text ">
                                <h3>{{ $item->top_banner_title }}</h3>
                                <p>{{ $item->top_banner_ta }}</p>
                                <a href="{{ route('shop')}}"><button type="button" class="btn btn">@lang('Shop Now')</button></a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--===========================banner part end===================================-->

    <!--===========================Our Best Collection part start===================================-->
                    
 
    <section class="our_best_collection">
        <div class="container">
            <div class="row mt-5" id="filter-buttons">
                <h2>{{ __('messages.OurBestCollection') }}</h2>
                <div class="col-12 text-center mt-4">
                    <button class="btn mb-2 me-1 active" data-filter="all">{{ __('messages.Showall') }}</button>

                    @foreach($categories as $cat)
                        <button class="btn mb-2 mx-1" data-filter="{{ $cat->slug}}">{{ $cat->name}}</button>
                    @endforeach
                    
                </div>
            </div>
            <div class="row px-2 mt-4 gap-3" id="filterable-cards">
				@foreach ($products as $item)
				<div class="card p-0" data-name="{{ $item->category->slug}}">
                    <div class="card-header">
                        <a href="{{ route('shop.details', $item->slug)}}"><img src="{{ $item->image }}"
                                alt="img"></a>
                    </div>
                    <div class="card-body">
                        <div class="rating  col-md-12 col-xl-12">
                            <p>{{$item->selling_price}}<strong>$</strong></p>
                            @php
                                $averageRating = getRatings($item->id);
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
                            <p>{{ $item->name }} </p>
                            <p>{{ __('messages.Dimension') }}: {{ $item->size }} </p>
                        </div>
                    </div>
                    <div class="woocommerce_cart">
                        <a href="javascript:void(0)" onclick="addToCart({{ $item['id'] }})">
                            <div class="woo_cart">
                                <i class="fa-solid fa-cart-plus"></i>
                            </div>
                        </a>
                        
                        <a href="{{route('wishlist.store', $item->id)}}" class="addToWish">
                            <div class="woo_cart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </a>

                        <div class="woo_cart">
                            <a href="{{ route('shop.details', $item->slug)}}"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>
				@endforeach				
            </div>
        </div>
    </section>
	
    <!--===========================Our Best Collection part end===================================-->

    <!--===========================Bowl Designs Products part start===================================-->
    <section class="Bowl_Designs">
        <div class="container">
            <div class="row">
                @foreach ($mainBanner as $item)
                    <div class="col-12">
                        <div class="bowldiv">
                            <div class="bowl_img">
                                <a href="{{ route('shop')}}"><img src="{{ asset('images/'.$item->main_banner_img)}}"
                                        alt="img" class="img-fluid"></a>
                            </div>
                            <div class="bowl_text ">
                                <h3>{{ $item->main_banner_title }}</h3>
                                <p>{{ $item->main_banner_tagline }}</p>
                                <a href="{{ route('shop')}}"><button type="button" class="btn btn">{{ __('messages.ShopNow') }}</button></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--===========================Bowl Designs Products part end===================================-->

    <!--===========================Bestseller Products part start===================================-->
    <section class="Bestseller_products">
        <div class="container text-center my-3">
            <h2 class=" pt-5 pb-5">{{ __('messages.BestsellerProducts') }}</h2>
            <div class="row mx-auto my-auto justify-content-center">
                <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($bestSeller as $item)
                            <div class="carousel-item active carouselitem">
                                <div class="col-md-3">
                                    <div class="card p-0">
                                        <div class="card-header">
                                            <a href="{{ route('shop.details', $item->slug)}}"><img src="{{ $item->image }}"
                                                    alt="img"></a>
                                        </div>
                                        <div class="card-body">
                                            <div class="rating  col-md-12 col-xl-12">
                                                <p>{{ $item->selling_price }}<strong>$</strong></p>
                                                @php
                                                    $averageRating = getRatings($item->id);
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
                                                <p>{{ $item->name }} </p>
                                                <p>{{ __('messages.Dimension') }}: {{ $item->size }} </p>
                                            </div>
                                        </div>
                                        <div class="woocommerce_cart">
                                            <a href="javascript:void(0)" onclick="addToCart({{ $item['id'] }})">
                                                <div class="woo_cart">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                </div>
                                            </a>
                                            <a href="{{route('wishlist.store', $item->id)}}" class="addToWish">
                                                <div class="woo_cart">
                                                    <i class="fa-regular fa-heart"></i>
                                                </div>
                                            </a>
                          
                                            <div class="woo_cart">
                                                <a href="{{ route('shop.details', $item->slug)}}"><i class="fa-solid fa-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--===========================Bestseller Products part end===================================-->

    <!--===========================double_product Products part start===================================-->
    <section class="double_product pb-5 pt-5">
        <div class="container">
            <div class="row">
                @foreach ($bottomBanner as $item)
                    <div class="col-md-6 doubleproduct prodouble">
                        <div class="handmadepot">
                            <a href="{{ route('shop')}}"><img src="images/{{ $item->bottom_banner_img }}"
                                    alt="img"></a>
                            <div class="handmadepot_text ">
                                <h3>{{ $item->bottom_banner_title }}</h3>
                                <p>{{ $item->bottom_banner_tagline }}</p>
                                <a href="{{ route('shop')}}"><button type="button" class="btn btn">{{ __('messages.ShopNow') }}</button></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--===========================double_product Products part end===================================-->

    <!--===========================gallery Products part start===================================-->
    <section class="gallery_product">
        <div class="container">
            <h3>{{ __('messages.Trendingstyle') }}</h3>
            <h2>{{ __('messages.NewProducts') }}</h2>
            <div class="row">
                @foreach ($newProduct as $item)
                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <a href="{{ route('shop.details', $item->slug)}}"><img src="{{ $item->image }}" alt="img"
                                class="w-100 shadow-1-strong rounded mb-4"></a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!--===========================gallery Products part end===================================-->

    @include('frontend.bottomLogos')

    
@endsection


@push('script')


<script>
    // Automatically advance carousel
    $('.carousel').carousel({
        interval: 5000 // Adjust interval as needed (in milliseconds)
    });
</script>
@endpush
