@extends('frontend.layout')
@section('title', 'Blog Details | Art Gallery')
@section('content')

<style>
textarea {
    border: 1px solid rgba(0, 0, 0, 0.175);
    border-radius: 4px;
    padding: 10px;
}

textarea:focus-visible {
    outline: none;
}

.comment_btn {
    max-width: 170px;
    margin-top: 15px
}

.body_blog .card-header {
    height: 243px;
    overflow: hidden;
    padding-top: 15px;
}
</style>

<!--===========================blog_detail part start===================================-->
<section class="all_products blog_Archives">
    <div class="container">
        <div class="breadcrumb d-flex gap-2">
            <p><a href="/"> {{ __('messages.Home') }} </a></p>
            <p> / </p>
            <p><a href="{{ route('front.blogs') }}"> {{ __('messages.Blog') }} </a></p>
        </div>
        <div class="row">
            <div class="blog_hedding">
                <h1>{{ __('messages.Blog') }}</h1>
            </div>
            <main class="col-md-9 our_best_collection blog_detail Related_Products all_product_gallerys">
                <div class="row">
                    <div class="col-12">
                        <figure class="card card-product-grid body_blog">
                            <div class="card p-0">
                                <div class="card-body">
                                    <img src="{{ asset($current_blog->banner) }}" style="height: 400px" alt="img">
                                    <div class="col-md-12 col-xl-12">
                                        <div class="blog_date_cmt d-flex justify-content-between">
                                            <p>
                                                <a href="{{ $current_blog['slug'] }}">
                                                    <span><i class="fa-solid fa-user-tie"></i></span> Posted by admin
                                                </a>
                                            </p>
                                            <p>
                                                <span><i class="fa-solid fa-calendar"></i></span>
                                                {{ date('F d, Y', strtotime($current_blog['created_at'])) }}
                                            </p>
                                        </div>
                                        <div class="blog_title">
                                            <h3>{{ $current_blog['short_description'] }}</h3>
                                        </div>
                                        <div class="rat col-md- col-xl-">
                                            {!! $current_blog['long_description'] !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>

                    </div>
                </div>
                
                @if(count($related_blog) > 0)
                <div class="row mt-3 mb-3">
                    <h2>{{ __('messages.RELATEDPOSTS') }}</h2>
                    <hr>

                    @foreach($related_blog as $blog_item)

                    @if($blog_item['slug'] != $current_blog['slug'])
                    <div class="col-md-6">
                        <figure class="card card-product-grid body_blog">
                            <div class="card p-0">
                                <div class="card-header">
                                    <a href="{{ $blog_item['slug'] }}"><img src="{{ asset($blog_item['banner']) }}"
                                            alt="img"></a>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 col-xl-12">
                                        <div class="blog_date_cmt d-flex justify-content-between">
                                            <p><span><i class="fa-solid fa-calendar"></i></span>
                                                {{ date('F d, Y', strtotime($current_blog['created_at'])) }}</p>
                                            <p><span><i class="fa-solid fa-comment"></i></span> 1
                                                {{ __('messages.Comment') }}</p>
                                        </div>
                                        <div class="blog_title">
                                            <a href="{{ $blog_item['slug'] }}">
                                                <h3>{{ $current_blog['short_description'] }}</h3>
                                            </a>
                                        </div>
                                        <div class="rat col-md- col-xl-">
                                            <p>{!! $current_blog['long_description'] !!}</p>
                                        </div>
                                        <div class="blog_btn">
                                            <a href="{{ $blog_item['slug'] }}">{{ __('messages.ReadMore') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <figure class="card card-product-grid p-3">
                            @foreach($comment as $itm)
                            <div class="blog_admin d-flex gap-3">
                                <div style="font-size: 40px; color:#6c757d;"><i class="fa-solid fa-circle-user"></i>
                                </div>
                                <div>
                                    <h4>{{ $itm->name }}</h4>
                                    <p>{{ $itm->created_at }}</p>
                                </div>
                            </div>
                            <div class="blg_text">
                                <p>{{ $itm->comment }}</p>
                            </div>
                            @endforeach

                            @if(isset(auth()->user()->role) && auth()->user()->role == 2 )
                            <form method="post" action="{{ route('blog-comment') }}" style="display: contents;">
                                @csrf
                                <textarea name="comment" name="comment" rows="4" cols="50"></textarea>
                                <input type="hidden" name="blog_id" value="{{ $current_blog['id'] }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button type="submit"
                                    class="btn btn-secondary comment_btn">{{ __('messages.AddComment') }}</button>
                            </form>
                            @else
                                <div class="blg_login">
                                    <h3>{{ __('messages.LeaveaReply') }} </h3>
                                    <p>{{ __('messages.Youmustbe') }} <span><a href="{{ route('customer-login') }}">{{ __('messages.login') }}</a></span> {{ __('messages.topostacomment') }}.</p>                          

                                </div>
                            @endif

                        </figure>
                    </div>
                </div>

            </main>

            @include('frontend.blogSideBar')

        </div>
    </div>
</section>
<!--===========================blog_detail part end===================================-->

@include('frontend.bottomLogos')

@endsection