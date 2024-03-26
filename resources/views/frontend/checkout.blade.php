@extends('frontend.layout')
@section('title', 'Checkout | Art Gallery')
@section('content')
<style>
    .card_section {
        display: none;
    }

    .card_section {
        display: none;
    }
</style>
<section class="check_out">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">{{ __('messages.Information') }}</h5>
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('customer.order', $customer->id )}}"
                            class="require-validation"  id="payment-form">
                            {!! csrf_field() !!}
                            {{ method_field('PUT') }}
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="fname">{{ __('messages.firstName') }}</label>
                                        <input type="text" id="firstName" name="firstName"
                                            value="{{ $customer->firstName }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('firstName') }}</small></b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="lname">{{ __('messages.lastName') }}</label>
                                        <input type="text" id="lastName" name="lastName"
                                            value="{{ $customer->lastName }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('lastName') }}</small></b>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="email">{{ __('messages.Email') }}</label>
                                        <input type="email" id="email" name="email" value="{{ $customer->email }}" class="form-control" />
                                       <b><small class="text-danger">{{ $errors->first('email') }}</small></b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="phone">{{ __('messages.Phone') }}</label>
                                        <input type="number" id="phone" name="phone" value="{{ $customer->phone }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('phone') }}</small></b>
                                    </div>
                                </div>
                            </div>                            
                            

                            <hr class="my-4" />
                            <div class="form-outline mb-4">
                                <h5>{{ __('messages.BillingDetails') }}</h5>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="address">{{ __('messages.StreetAddress') }}</label>
                                <input type="text" id="street_address" name="billing[street_address]" value="{{ $billing_address->b_address_one ?? '' }}" class="form-control" />
                                <b><small class="text-danger">{{ $errors->first('street_address') }}</small></b>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.City') }}</label>
                                        <input type="text" name="billing[city]" value="{{ $billing_address->b_city ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.State') }}</label>
                                        <input type="text" name="billing[state]" value="{{ $billing_address->b_state ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.Zip') }}</label>
                                        <input type="text" name="billing[postal]" value="{{ $billing_address->b_zip ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.Country') }}</label>
                                        <input type="text" name="billing[country]" value="{{ $billing_address->b_country ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                            </div>


                            <div style="display:none" id="shipping-details">
                            <div class="form-outline mb-4">
                                <h5>{{ __('messages.ShippingDetails') }}</h5>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="address">{{ __('messages.StreetAddress') }}</label>
                                <input type="text" id="street_address" name="shipping[street_address]" value="{{ $shipping_address->s_address_one ?? '' }}" class="form-control" />
                                <b><small class="text-danger">{{ $errors->first('street_address') }}</small></b>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.City') }}</label>
                                        <input type="text" name="shipping[city]" value="{{ $shipping_address->s_city ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.State') }}</label>
                                        <input type="text" name="shipping[state]" value="{{ $shipping_address->s_state ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.Zip') }}</label>
                                        <input type="text" name="shipping[postal]" value="{{ $shipping_address->s_zip ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="">{{ __('messages.Country') }}</label>
                                        <input type="text" name="shipping[country]" value="{{ $shipping_address->s_country ?? '' }}" class="form-control" />
                                        <b><small class="text-danger">{{ $errors->first('') }}</small></b>
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                            <hr class="my-4" />
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="same_as_billing" checked id="checkformone" />
                                <label class="form-check-label" for="checkformone">
                                    {{ __('messages.ShippingBilling') }}
                                </label>
                            </div>

                            <hr class="my-4" />
                            <h5 class="mb-4">{{ __('messages.Payment') }}</h5>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="cod"
                                    id="checkoutForm" checked />
                                <label class="form-check-label" for="checkoutForm">{{ __('messages.CashOnDelivery') }}</label>
                            </div>
                            @if($general->stripe_payment == 'on')
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="checkoutForm3" value="card" />
                                <label class="form-check-label" for="checkoutForm3">Credit card</label>
                            </div>
                            <input type="hidden" name="stripeToken" id="stripeToken">
                            <div class="card_section mt-3 mb-3" id="card-element"> </div>
                            @endif 
                            <button class="btn btn-lg btn-block mt-2" type="submit">
                                {{ __('messages.Continuetocheckout') }}
                            </button>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">{{ __('messages.Summary') }}</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                {{ __('messages.Subtotal') }}
                                <span>{{ Cart::subtotal() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                {{ __('messages.Tax') }}
                                <span>{{ Cart::tax() }}</span>
                            </li>
                            <li class="list-group-item d-block justify-content-between align-items-center px-0">
                                <div>{{ __('messages.Coupon') }}</div>
                                <div>
                                    <input class="form-control" placeholder="Enter your code" id="coupon_code" value="">
                                    <b class="text-danger d-block" id="coupon_message"></b>
                                    <button type="button" class="btn mt-2" id="apply_coupon">{{ __('messages.ApplyCoupon') }}</button>
                                </div>
                            </li>
                            
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>{{ __('messages.Discount') }}</strong>
                                </div>
                                <span><strong id="dicount">0</strong></span>
                            </li>

                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>{{ __('messages.Totalamount') }}</strong>
                                    <strong>
                                        <p class="mb-0">({{ __('messages.includingVAT') }})</p>
                                    </strong>
                                </div>
                                <span><strong id="total">{{ Cart::total(2, '.', '') }}</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--===========================check_out part end===================================-->

@include('frontend.bottomLogos')
@endsection
@push('script')
<script src="https://js.stripe.com/v3/"></script>
<script>
    $('#checkoutForm').on('click', function () {
        if ($('#checkoutForm').is(':checked')) {
            $(".card_section").hide();
        }
    });

    $('#checkoutForm3').on('click', function () {
        $(".card_section").show();
        var stripe = Stripe('{{ env("STRIPE_KEY") }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Show error to your customer
                    console.error(result.error.message);
                } else {
                    // Token successfully created, add it to the form and submit
                    var tokenInput = document.getElementById('stripeToken');
                    tokenInput.value = result.token.id;
                    form.submit();
                }
            });
        });
    });


    $("#apply_coupon").on('click', function (e) {
        e.preventDefault();
        $('#coupon_message').empty();
        var coupon_code = $("#coupon_code").val();
        if (!coupon_code) {
            $('#coupon_message').text("Coupon code is empty");
        } else {
            $.ajax({
                url: "{{ route('discount.coupon') }}",
                type: 'post',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'coupon_code': coupon_code,
                },
                dataType: 'json',
                success: function (res) {
                    if (res.error) {
                        $('#coupon_message').text(res.error);
                    }

                    if (res.discount_amount) {
                        console.log(res.discount_amount)
                        $('#dicount').text(res.discount_amount);
                        $('#total').text(res.total);
                    }

                }
            });
        }
    });

    $('#checkformone').change(function() {
        if (this.checked) {
            // If checkbox is checked, hide the shipping details
            $('#shipping-details').hide();
        } else {
            // If checkbox is unchecked, show the shipping details
            $('#shipping-details').show();
        }
    });
</script>

<script>
    $(document).ready(function(){
        $('#checkformone').on('click', function(){
            if($('#checkformone').is(':checked')){
                $("#form-shipping").remove();
            }else{
                $('#form-billing').after('<div class="form-outline mb-4" id="form-shipping"> <label class="form-label" for="address">Shipping  Address</label> <input type="text" id="shipping_address" name="shipping_address" value="" class="form-control" /> </div>');
            }

        });
    });
</script>

@endpush