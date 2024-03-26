@extends('frontend.layout')
@section('title', $page->title)
@section('content')
<section class="guides pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>

@endsection