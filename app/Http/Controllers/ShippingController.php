<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Shipping;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    public function indexshipping(){
        
        $shipping['shipping'] = Shipping::where('customer_id','=', auth()->user()->id)->first();
        return view('customer/shipping', $shipping);
    }
    
    public function updateshipping(Request $request)
        {
            $input = $request->all();
            $shipping = Shipping::where('customer_id',auth()->user()->id)->first();
            if (!$shipping) {
                Shipping::create([
                    'customer_id' => auth()->user()->id,
                    's_address_one' => $input['s_address_one'],
                    's_address_two' => $input['s_address_two'],
                    's_city' => $input['s_city'],
                    's_state' => $input['s_state'],
                    's_zip' => $input['s_zip'],
                    's_country' => $input['s_country'],
                ]);

                
                $message = 'Shipping information created.';
                return redirect()->route('shipping.index')->with('success', $message)->with('flash_message' , "Added");


            } else {
                $details = Shipping::find($shipping['id']);
                $details->s_address_one = $input['s_address_one'];
                $details->s_address_two = $input['s_address_two'];
                $details->s_city = $input['s_city'];
                $details->s_state = $input['s_state'];
                $details->s_zip = $input['s_zip'];
                $details->s_country = $input['s_country'];
                $details->save();
                
                $message = 'Shipping information Updated.';
                return redirect()->route('shipping.index')->with('success', $message)->with('flash_message' , "Updated");
            }
            
    }
}