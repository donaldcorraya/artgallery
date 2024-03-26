<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use App\Models\Billing;
use Cache;
use App\Models\Shipping;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\OrderDetailsModel;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function tax(){
        $tax = Tax::first()->tax;
        return $tax;
    }
    
    public function addToCart(Request $request){
        $product = ProductModel::find($request->id);
        
        if(!$product){
            return response()->json([
                'status' => false,
                'message' => "Product not found"
            ]);
        }
    
        $cartContent = Cart::content();
        $productAlreadyExist = $cartContent->contains('id', $product->id);
    
        if($productAlreadyExist){
            $status = false;
            $message = "$product->name is already added in cart";
        } else {
            // Cart::add([
            //     'id' => $product->id,
            //     'name' => $product->name,
            //     'qty' => 1,
            //     'price' => $product->selling_price,
            //     'options' => [
            //         'productImage' => $product->image
            //     ],
            //     'tax' => $this->tax
            // ]);

            Cart::add($product->id, $product->name, 1,$product->selling_price, ['productImage' => $product->image], $this->tax());
            
            $status = true;
            $message = "$product->name is added in cart";
        }
    
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }
    

    public function getCartDetails(){
        $cartContent = Cart::content();
        $total = Cart::total();
        return view('frontend.cart_partial', compact('cartContent', 'total'));
    }


    public function cart(){
        $cartContent = Cart::content();
        return view('frontend.cart', compact('cartContent'));
    }

    public function updateCart(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = ProductModel::find($itemInfo->id);

        if($qty <= $product['stock_amount']){
            Cart::update($rowId, $qty);
            $message = "Cart updated successfully";
            $status = true;
            session()->flash('success', $message);
        }else{
            $message = "Requested quantity ($qty) not available in stock";
            $status = false;
            session()->flash('error', $message);
        }  

        
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function deleteItem(Request $request){        

        $rowId = $request->rowId;
        $itemInfo = Cart::get($rowId);

        if($itemInfo ==null){
            $message = "Item is not found in cart";
            session()->flash('error', $message);

            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        Cart::remove($request->rowId);

        $message = "Item is deleted from cart";
        session()->flash('success', $message);               
        return response()->json([              
            'status' => true,
            'message' => $message
        ]);
    }

    public function removeItem($id){
        Cart::remove($id);
        return response()->json([              
            'status' => true,
            'message' => 'Product removed successfully'
        ]);
    }

    public function addToCartWithQty(Request $request){
        $product = ProductModel::find($request->id);
        
        if(!$product){
            return response()->json([
                'status' => false,
                'message' => "Product not found"
            ]);
        }
    
        $cartContent = Cart::content();
        $productAlreadyExist = $cartContent->contains('id', $product->id);
    
        if($productAlreadyExist){
            $status = false;
            $message = "$product->name is already added in cart";
        } else {
            // Cart::add([
            //     'id' => $product->id,
            //     'name' => $product->name,
            //     'qty' => $request->qty,
            //     'price' => $product->selling_price,
            //     'options' => [
            //         'productImage' => $product->image
            //     ],
            //     'tax' => $this->tax
            // ]);

            Cart::add($product->id, $product->name, $request->qty ,$product->selling_price, ['productImage' => $product->image], $this->tax());
    
            $status = true;
            $message = "$product->name is added in cart";
        }
    
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }
    

    
    public function checkout(){        

        if(!Auth::check()){
            return redirect()->route('customer.login')->withError('Please login');
        }
        if(Cart::count() == 0){
            return redirect()->route('home');
        }

        if(auth()->user()->id == 1){
            return redirect()->route('customer.login')->withError('Admin cannot go to checkout');
        }
        
        $customer_id = auth()->user()->id;        
        $customer = CustomerModel::where('user_id', $customer_id)->first();
        $billing_address = Billing::where('customer_id', $customer_id)->first();
        $shipping_address = Shipping::where('customer_id', $customer_id)->first();
        return view('frontend.checkout',compact('customer', 'billing_address', 'shipping_address'));
    }


    public function order(Request $request, $id){ 
        $input = $request->all();          
        $validator = Validator::make($request->all(), [
            'billing.street_address' => 'required|string',
            'billing.city' => 'required|string',
            'billing.state' => 'required|string',
            'billing.postal' => 'required|string',
            'billing.country' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withError('Please add billing information');
        }

        DB::beginTransaction();
        
        try {
            $dicount = Cache::get('discount');
            $general = gs();
            $total_cost = Cart::total(0, '', '') - $dicount;  
            if($total_cost < 0){
                return back()->with('error', "Total amount must be greater thean 0");
            }
            $details = CustomerModel::where('user_id', auth()->user()->id)->first();

            if($request->flexRadioDefault == 'card' && $general->stripe_payment = 'on'){
                $prc = new StripePaymentController();
                $payment = $prc->stripePost($request);
            }

            $product_arr = array();
            foreach(Cart::content() as $pitm){
                $product_itm = array(
                    'product_id' => $pitm->id,
                    'product_name' => $pitm->name,
                    'product_price' => $pitm->price,
                    'product_qty' => $pitm->qty,
                );                    
                array_push($product_arr, $product_itm);
            }

            $billing = json_encode($request->billing);

            if($request->same_as_billing == 'on'){
                $shipping = $billing;
            }else{
                $shipping = json_encode($request->shipping);
            }

            OrderModel::create([
                'customer_id'=> auth()->user()->id,
                'phone' => $details->phone ?? 01312,
                'email' => $details->email ?? 'test@test.com',
                'order_total' => $total_cost,
                'tax_total' => Cart::tax(0, '', ''),
                'shipping_total' => 0,
                'order_date' => now(),
                'order_timestamp' => now(),
                'payment_method' => $request->flexRadioDefault,
                'payment_amount' => $total_cost,
                'payment_date' => now(),
                'payment_timestamp' => now(),
                'payment_status' => '0',
                'currency' => 'usd',
                'transaction_id' => time(),
                'coupon' => (Session::get('coupon'))? Session::get('coupon') : '',
                'billing' => $billing,
                'shipping' => $shipping,
                'product_arr' => json_encode($product_arr)
            ]); 

             // Update product stock
            foreach($product_arr as $product_item) {
                $product = ProductModel::find($product_item['product_id']);
                if ($product) {
                    $product->stock_amount -= $product_item['product_qty'];
                    $product->save();
                }
            }
            Cache::forget('discount');
            Cart::destroy();
            DB::commit(); 
            return redirect()->route('order_completed');
        

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());

        }
        
    }    

}