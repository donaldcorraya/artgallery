@extends('admin.layout')
@section('title', 'General Setting')
@section('content')

<section class="main" id="main">
    <form action="{{ route('setting-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Business Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" placeholder="Enter Title" class="form-control" name="business_name"
                                    required="" value="{{ $general->business_name}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Business Address: <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="address" placeholder="Enter Address" class="form-control"
                                    name="business_address" required="" value="{{ $general->business_address}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Business Phone
                                Number: <span class="text-danger">*</span> </label>
                            <div class="col-sm-12">
                                <input type="tel" placeholder="Enter Number" class="form-control" name="business_number"
                                    required="" value="{{ $general->business_number}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Business Email: <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="email" placeholder="Enter email" class="form-control" name="business_email"
                                    required="" value="{{ $general->business_email}}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-12 col-form-label">Payment Method </label>
                            <div class="col-sm-12">
                                <div class="form-check">

                                    <input type="checkbox" class="form-check-input" style="border-radius: 50%;"
                                        name="stripe_payment" {{ $general->stripe_payment ? 'checked' : '' }}
                                    id="stripe_payment-checkbox">

                                    <label class="form-check-label" for="stripe_payment-checkbox">
                                        Stripe Available
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 myDiv" @if($general->stripe_payment == null) style="display:none" @endif>
                            <label for="inputText" class="col-sm-12 col-form-label">Stripe Key <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="stripe_key"
                                    value="{{ $general->stripe_key}}">
                            </div>
                        </div>

                        <div class="row mb-3 myDiv" @if($general->stripe_payment == null) style="display:none" @endif>
                            <label for="inputPassword" class="col-sm-12 col-form-label"> Stripe Secret <span
                                    class="text-danger">*</span>
                            </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="stripe_secret"
                                    value="{{ $general->stripe_secret}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5 mt-3">
                            <label class="col-sm-4 col-form-label"> Logo <span class="text-danger">*</span> </label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <input type="file" name="logo"
                                                accept="image/png, image/jpg, image/gif, image/jpeg"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        @if($general->logo)
                                        <img src="{{ asset('assets/images/setting/' . $general->logo) }}" alt=""
                                            class="img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5 mt-3">
                            <label class="col-sm-4 col-form-label"> FavIcon <span class="text-danger">*</span> </label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group">
                                            <input type="file" name="favicon"
                                                accept="image/png, image/jpg, image/gif, image/jpeg"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        @if($general->favicon)
                                        <img src="{{ asset('assets/images/setting/' . $general->favicon) }}" alt=""
                                            class="img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5 mt-5">
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <a class="btn btn-danger" style="margin-right: 10px"
                                        href="{{ route('dashboard') }}">Cancel </a>
                                    <button class="btn btn-info" type="submit">Save </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </form>
</section>

@endsection

@push('script')
<script>
    @foreach($errors -> all() as $error)
    toastr.error("{{ $error }}");
    @endforeach


    $(document).ready(function () {
        $('#stripe_payment-checkbox').change(function () {
            $('.myDiv').toggle(this.checked);
        });

        // Initial state check
        if ($('#stripe_payment-checkbox').is(':checked')) {
            $('.myDiv').show();
        } else {
            $('.myDiv').hide();
        }
    });
</script>
@endpush