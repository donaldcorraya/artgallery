@extends('admin.layout')
@section('title', 'Footer | Address')
@section('content')


<main id="main" class="main">
    <div class="pagetitle">

        @if(session('flash_message'))
            <p class="alert alert-success text-center" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">{{session('flash_message')}}</p>
        @endif


        <h1>Address</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Address</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title ">Address</h5>  
                        <form action="{{ route('footer-update', $arr['id']) }}" method="POST">                      
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="Email" class="form-label">Address</label>
                                    <div class="col-lg-12">
                                        <input class="form-control" value="{{ $arr['address'] }}" name="address" type="text" placeholder="Address">
                                        <b><small class="text-danger">{{ $errors->first('address') }}</small></b>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label for="Email" class="form-label">Phone</label>
                                    <div class="col-lg-12">
                                        <input class="form-control" value="{{ $arr['phone'] }}" name="phone" type="text" placeholder="Phones">
                                        <b><small class="text-danger">{{ $errors->first('phone') }}</small></b>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="Email" class="form-label">Email Address</label>
                                    <div class="col-lg-12">
                                        <input class="form-control" value="{{ $arr['emaiL_address'] }}" name="email_address" type="text" placeholder="Email Address">
                                        <b><small class="text-danger">{{ $errors->first('emaiL_address') }}</small></b>
                                    </div>
                                </div>    
                                <div class="col-lg-2 mb-3">
                                    <button type="submit" class="form-control btn btn-primary">Save</button>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

@endsection
