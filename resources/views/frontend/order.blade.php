@extends('frontend.layout')
@section('title', 'Order | Art Gallery')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-body bg-light">
                    <div class="text-center">
                        <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125"
                            height="120" class="img-fluid" alt="Thank You Image">
                        <h2 class="mt-4 mb-0">{{ __('messages.Thank') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection