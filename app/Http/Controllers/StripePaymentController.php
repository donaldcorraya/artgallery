<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripePaymentController extends Controller
{
    public function stripePost($request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $total = Cart::total();
        $response= Charge::create ([
            "amount" => (int)$total * 100 ?? 0,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment Received" 
        ]);
        return $response;
    }
}