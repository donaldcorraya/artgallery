@extends('frontend.layout')
@section('title', 'Blog | Art Gallery')

@section('content')

<style>
	.active .page-link,
	.page-link.active {
		background-color: #fa8231;
		border-color: #fa8231;
	}
    .body_blog .card-header{height: 243px; overflow: hidden; padding-top: 15px;}
    .rat{ height: 100px; overflow: hidden; }
    .blog_title{ height: 80px; overflow: hidden; }
</style>
<!--===========================blog_Archives part start===================================-->
<section class="all_products blog_Archives">
    <div class="container">
        <div class="breadcrumb d-flex gap-2">
            <p><a href="/"> {{ __('messages.Home') }} </a></p>
            <p> / </p>
            <p><a href="{{ route('front.blogs') }}"> {{ __('messages.Blog') }} </a></p>
        </div>
        <div class="row">
            <div class="blog_hedding">
                <h1>{{ __('messages.blogArchives') }}</h1>
            </div>
            <main class="col-md-9 our_best_collection Related_Products all_product_gallerys">
                <div class="row">
                    @forelse($arr as $item)
                    <div class="col-md-6">
                        <figure class="card card-product-grid body_blog">
                            <div class="card p-0">
                                <div class="card-header">
                                    <a href="{{ route('front.blogsDetails', ['slug' => $item['slug']])}}"><img src="{{ asset($item['banner']) }}" alt="img"></a>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 col-xl-12">
                                        <div class="blog_date_cmt d-flex justify-content-between">
                                            <p><span><i class="fa-solid fa-calendar"></i></span> {{ date('F d, Y', strtotime($item['created_at'])) }} </p>
                                            <p><span><i class="fa-solid fa-pencil"></i></span> Posted By Admin</p>
                                        </div>
                                        <div class="blog_title">
                                            <a href="{{ route('front.blogsDetails', ['slug' => $item['slug']])}}">
                                                <h3>{{ $item['title'] }}</h3>
                                            </a>
                                        </div>
                                        <div class="rat col-md- col-xl-">
                                            <p>{{ $item['short_description'] }}</p>
                                        </div>
                                        <div class="blog_btn">
                                            <a href="{{ route('front.blogsDetails', ['slug' => $item['slug']])}}">{{ __('messages.ReadMore') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                    </div>
                    @empty 
                    <h3>Nothing found here !</h3>
                    @endforelse
                </div>
                
                {{ $arr->links() }}		

            </main>
            @include('frontend.blogSideBar')
        </div>
    </div>
</section>
<!--===========================blog_Archives part end===================================-->

@include('frontend.bottomLogos')
@endsection