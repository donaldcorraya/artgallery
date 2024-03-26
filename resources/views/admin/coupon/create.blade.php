@extends('admin.layout')
@section('title', 'Coupon Create | Art Gallery')
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<style>
    .form-label {
        padding-top: 15px;
    }

    .card {
        margin-bottom: 0;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">        
        <h1>Coupon</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/coupon')}}">Coupon</a></li>
                    <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <form class="row g-3" action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <label for="code" class="form-label">Code<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('code') }}" name="code" class="form-control" id="code" required>
                                <b><small class="text-danger">{{ $errors->first('code') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" required>
                                <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="max_uses" class="form-label">Max Uses<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('max_uses') }}" name="max_uses" class="form-control" id="max_uses" required>
                                <b><small class="text-danger">{{ $errors->first('max_uses') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="max_uses_user" class="form-label">Max Uses User<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('max_uses_user') }}" name="max_uses_user" class="form-control" id="max_uses_user" required>
                                <b><small class="text-danger">{{ $errors->first('max_uses_user') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="type" class="form-label">Type<span class="text-danger">*</span></label>
                                <select class="form-select" name="type" aria-label="Default select example">
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percent</option>
                                </select
                                <b><small class="text-danger">{{ $errors->first('type') }}</small></b>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <label for="discount_amount" class="form-label">Discount Amount<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('discount_amount') }}" name="discount_amount" class="form-control" id="discount_amount" required>
                                <b><small class="text-danger">{{ $errors->first('discount_amount') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="max_amount" class="form-label">Max Amount<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('max_amount') }}" name="max_amount" class="form-control" id="max_amount" required>
                                <b><small class="text-danger">{{ $errors->first('max_amount') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="min_amount" class="form-label">Min Amount<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('min_amount') }}" name="min_amount" class="form-control" id="min_amount" required>
                                <b><small class="text-danger">{{ $errors->first('min_amount') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="starts_at" class="form-label">Starts At<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('starts_at') }}" name="starts_at" class="form-control" id="starts_at" autocomplete="off" required>
                                <b><small class="text-danger">{{ $errors->first('starts_at') }}</small></b>
                                @if(Session::has('starts_at'))
                                <b><small class="text-danger">{{ Session::get('starts_at') }}</small></b>
                                @endif
                            </div>

                            <div class="col-12">
                                <label for="expires_at" class="form-label">expires_at<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('expires_at') }}" name="expires_at" class="form-control" id="expires_at" autocomplete="off" required>
                                <b><small class="text-danger">{{ $errors->first('expires_at') }}</small></b>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" value="{{ old('description') }}" name="description" class="form-control" id="description"></textarea>
                                <b><small class="text-danger">{{ $errors->first('description') }}</small></b>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
</main>

<script>
    $("#expires_at").datepicker({
        format: 'Y-m-d H:i:s',
    });

    $("#starts_at").datepicker({
        format: 'Y-m-d H:i:s',
    });
</script>

@endsection