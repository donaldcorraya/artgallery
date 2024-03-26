@extends('frontend.layout')
@section('title', 'Wishlist Product | Art Gallery')
@section('content')


<style>
	.active .page-link,
	.page-link.active {
		background-color: #fa8231;
		border-color: #fa8231;
	}
</style>

<!--===========================all_products part start===================================-->
<section class="our_best_collection">
        <div class="container">
            <div class="row px-2 gap-3" id="filterable-cards">
                @forelse ($wishlists as $item)
				<div class="card p-0" data-name="Coffee">
                    <div class="card-header">
                        <a href="{{ route('shop.details', $item->product->slug)}}"><img src="{{ $item->product->image }}"
                                alt="img"></a>
                    </div>
                    <div class="card-body">
                        <div class="rating  col-md-12 col-xl-12">
                            <p>{{$item->product->selling_price}}<strong>$</strong></p>
                            <div class="rat col-md- col-xl-">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p>{{ $item->product->name }} </p>
                            <p>{{ __('messages.Dimension') }}: {{ $item->product->size }} </p>
                        </div>
                    </div>
                    <div class="woocommerce_cart">
                        <a href="javascript:void(0)" onclick="addToCart({{ $item->product->id }})">
                            <div class="woo_cart">
                                <i class="fa-solid fa-cart-plus"></i>
                            </div>
                        </a>

                        <div class="woo_cart">
                            <a href="{{ route('shop.details', $item->product->slug)}}"><i class="fa-solid fa-eye"></i></a>
                        </div>
                        
                        <div class="woo_cart">
                            <a href="{{ route('wishlist.destroy', $item->id)}}"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                @empty 
                <p>Nothing found here ! </p>
				@endforelse
            </div>
        </div>
    </section>
@endsection