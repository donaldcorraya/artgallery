<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Billing;
use Illuminate\Support\Facades\Session;


class BillingController extends Controller
{
    public function indexbilling(){
        
        $billing['billing'] = Billing::where('customer_id','=', auth()->user()->id)->first();
        return view('customer/billing', $billing);
    }
    
    public function updatebilling(Request $request)
        {
            $input = $request->all();
            $billing = Billing::where('customer_id',auth()->user()->id)->first();
            if (!$billing) {
                Billing::create([
                    'customer_id' => auth()->user()->id,
                    'b_address_one' => $input['b_address_one'],
                    'b_address_two' => $input['b_address_two'],
                    'b_city' => $input['b_city'],
                    'b_state' => $input['b_state'],
                    'b_zip' => $input['b_zip'],
                    'b_country' => $input['b_country'],
                ]);

                
                return redirect()->route('billing.index')->with('flash_message' , "Added");


            } else {
                $details = Billing::find($billing['id']);
                $details->b_address_one = $input['b_address_one'];
                $details->b_address_two = $input['b_address_two'];
                $details->b_city = $input['b_city'];
                $details->b_state = $input['b_state'];
                $details->b_zip = $input['b_zip'];
                $details->b_country = $input['b_country'];
                $details->save();
                
                return redirect()->route('billing.index')->with('flash_message' , "Updated");
            }
            
    }
}
