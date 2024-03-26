<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\User;
use App\Models\OrderModel;
use App\Models\RatingModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\DB;
use App\Models\DiscountCouponModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            if(auth()->user()->role == 2){      
                Auth::logout();      
                return redirect('customer_dashboard');
            }
        }else{
            return view('customer.index');
        }
       
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $details = CustomerModel::find($id);
        $input = $request->all();    
          
        
        if (array_key_exists("current_password",$input)){

            $user = User::find(auth()->user()->id);
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|confirmed|',
                'new_password_confirmation' => 'required|same:new_password|different:current_password',
            ]);

            #Match The Old Password
            if(Hash::check($input['current_password'], $user['password'])){
                $new_password['password'] = Hash::make($input['new_password']);
                $user->update($new_password);
                return redirect('customer_dashboard')->with('flash_message', 'Password has been changed');
            }else{
                return redirect('customer_dashboard')->with('error', 'Current password not correct');
            }



        }


        request()->validate([
            'firstName' => 'min:3|regex:/^[A-Za-z_-]/',          
            'lastName' => 'min:3|regex:/^[A-Za-z_-]/',          
            'phone' => 'required|numeric|digits_between:8,15',
            'email' => '',
            'date_of_birth' => 'string|min:3|max:64|nullable',
            'gender' => 'string|min:4|max:10|nullable',
            'address_one' => 'string|min:3|max:64|nullable',
            'address_two' => 'string|min:3|max:64|nullable',
            'city' => 'string|min:3|max:64|nullable',
            'state' => 'string|min:3|max:64|nullable',
            'post' => 'string|min:3|max:64|nullable',
            'country' => 'string|min:3|max:64|nullable',
            'ssn' => 'string|min:3|max:64|nullable',
            'company' => 'string|min:3|max:64|nullable',
            'website' => 'string|min:3|max:255|nullable',
            'facebook' => 'string|min:3|max:255|nullable',
            'linkedIn' => 'string|min:3|max:255|nullable',
            'twitter' => 'string|min:3|max:255|nullable',
            'youtube' => 'string|min:3|max:255|nullable',
            'instagram' => 'string|min:3|max:255|nullable',
            'marital_status' => 'min:1|max:1|nullable'
        ]);
        

        if (isset($input['image'])) {

            $destinationPath = 'storage/images/Customers/';
            $filename = $destinationPath . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);

            $input['image'] = $filename;

            if (file_exists($input['old_img'])) {
                unlink($input['old_img']);
            }
        }

        
        $details->update([
            'firstName'       =>  $input['firstName'],
            'lastName'        => $input['lastName'],
            'phone'           => $input['phone'],
            'email'           => $input['email'],
            'date_of_birth'   => $input['date_of_birth'],
            'gender'          => $input['gender'],
            'image'           => isset($input['image'])? $input['image']: ''
        ]);

        if(isset($input['firstName']) or isset($input['lastName'])){  
            $name = $input['firstName'].' '.$input['lastName'];

            $user = User::find(auth()->user()->id);

            $user->update([
                'name' => $name
            ]);
        }

        if(isset($input['address_one']) or isset($input['address_two']) or isset($input['city']) or isset($input['state']) or isset($input['post']) ){


            $billing = Billing::where('customer_id', auth()->user()->id);

            $billing->update([
                'b_address_one' => isset($input['address_one'])? $input['address_one'] : '',
                'b_address_two' => isset($input['address_two'])? $input['address_two'] : '',
                'b_city'        => isset($input['city'])? $input['city'] : '',
                'b_state'       => isset($input['state'])? $input['state'] : '',
                'b_zip'        => isset($input['post'])? $input['post'] : '',
                'b_country'        => isset($input['country'])? $input['country'] : '',
            ]);

        }

        return redirect('customer_dashboard')->with('flash_message', 'Updated');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function customerDashboard(){
        $data = CustomerModel::where('user_id', auth()->user()->id)->first();       

        $data = DB::table('users')
            ->select('*')
            ->join('billings', 'billings.customer_id', '=', 'users.id')
            ->join('customers', 'customers.user_id', '=', 'users.id')
            ->where('users.id', auth()->user()->id)
            ->first();

        $address = DB::table('billings')
            ->select('*')           
            ->where('customer_id', auth()->user()->id)
            ->first();
        //dd($address);
        return view('customer.dashboard',compact('data', 'address'));
    }

    

    public function customer_order(Request $request){


        $input = $request->all();
        if(isset($input['status_type'])){
            if($input['status_type'] == 1){
                $status_type = 'order_status';
            }

            if($input['status_type'] == 2){
                $status_type = 'delivery_status';
            }
            $arr = OrderModel::where('customer_id','=', auth()->user()->id)->where($status_type, '=', $input['delivery_status'])->get();
            return view('customer.customerOrder', compact('arr'));
        }else{
            
            $arr = OrderModel::where('customer_id', auth()->user()->id)->get();
            return view('customer.customerOrder', compact('arr'));
        }
        
    }

    public function orderDetails($id){

        $data = OrderModel::where('customer_id', auth()->user()->id)->where('id',$id)->first();

        if(empty($data)){
            return redirect()->route('customer.order.dashboard');
        }
       
        
        return view('customer.orderDetails',[
            'product' => $data,
        ]);
        
    }

    public function order_completed(){
        return view('frontend.order');
    }

    public function adminCustomerOrders(Request $request){
        $input = $request->all();
        $filter = 1;

        if($input){
            $arr = OrderModel::where('order_status', '=', $input['delivery_status'])->get();  
        }else{
            $arr = OrderModel::all();
        }
        

        
         
        return view('customer.adminCustomerOrders', compact('arr', 'filter'));
        
    }

    public function orderPending(){
        $arr = OrderModel::where('order_status', '=', 0)->get();        
        return view('customer.adminCustomerOrders', compact('arr'));
    }

    public function orderAccepted(){
        $arr = OrderModel::where('order_status', '=', 1)->get();
        return view('customer.adminCustomerOrders', compact('arr'));
    }

    public function orderDelivered(){
        $arr = OrderModel::where('order_status', '=', 2)->get();
        return view('customer.adminCustomerOrders', compact('arr'));
    }
    public function orderConfirmed(){
        $arr = OrderModel::where('order_status', '=', 3)->get();
        return view('customer.adminCustomerOrders', compact('arr'));
    }

    public function orderCancelled(){
        $arr = OrderModel::where('order_status', '=', 4)->get();
        return view('customer.adminCustomerOrders', compact('arr'));
    }


    public function adminOrderDetails($id){    
        
        $data = DB::table('orders')
            ->join('customers', 'customers.user_id', '=', 'orders.customer_id')
            ->join('users', 'users.id', '=', 'orders.customer_id')
            ->where('orders.id', '=', $id)
            ->first();  
            if (!$data) {
                return redirect()->back();
            }   
        
        $delivery_date = count(DB::select("SELECT delivery_date FROM orders WHERE id = ".$id." AND delivery_date IS NOT NULL"));
        
        if($delivery_date > 0){
            $delivery_status = false;
        }else{
            $delivery_status = true;
        }

        if($data->order_status == 4 || $data->order_status == 3 || $data->order_status == 2){
            $delivery_status = false;
        }

        if($data->order_status == 1){
            $delivery_status = true;
        }

        if($data->order_status == 0){
            $delivery_status = false;
        }

        if(empty($data)){
            return redirect()->route('customer.order.dashboard');
        }

        $status = self::getStatus($data->order_status);
        return view('customer.adminCustomerOrderDetails',[
            'arr' => $data,
            'order_id' => $id,
            'status' => $status,
            'status_id' => $data->order_status,
            'status_value' => self::getStatusValue($data->order_status),
            'delivery_date' => $data->delivery_date,
            'delivery_status' => $delivery_status,
        ]);
    }    


    private function getStatusValue($id) {
        if($id == 0){
            $status_value = 'Pending';
            return $status_value;
        }
        if($id == 1){
            $status_value = 'Accepted';
            return $status_value;
        }

        if($id == 2){
            $status_value = 'Delivered';
            return $status_value;
        }

        if($id == 3){
            $status_value = 'Confirmded';
            return $status_value;
        }
    }

    private function getStatus($id) {
        if($id == 0){
            return $getStatus = array( 
                '0' => 'Pending',
                '1' => 'Accepted',
                '2' => 'Delivered',
                '3' => 'Confirmded',
                '4' => 'Canceled'
            );
        }
        if($id == 1){
            return $getStatus = array(
                '1' => 'Accepted',
                '2' => 'Delivered',
                '3' => 'Confirmded',
            );
        }
        if($id == 2){
            return $getStatus = array(
                '2' => 'Delivered',
                '3' => 'Confirmded',
            );
        }
        if($id == 3){
            return $getStatus = array(
                '3' => 'Confirmded'
            );
        }
        if($id == 4){
            return $getStatus = array(
                '4' => 'Canceled'
            );
        }
        if($id == 5){
            return $getStatus = array('none');
        }
    }

    public function delete($id)
    {
        $post = OrderModel::find($id);
        $post->delete();

        return redirect()->route('front.adminCustomerOrders')->with('success', 'Post deleted successfully.');
    }
    

    public function search_ajax(Request $request){
        if($request->ajax()){
            $input = $request->all();

            $data = DB::select("SELECT name, regular_price, slug, selling_price, image FROM products WHERE `name` LIKE '%".$input['str']."%' OR short_description LIKE '%".$input['str']."%' OR `long_description` LIKE '%".$input['str']."%' OR slug LIKE '%".$input['str']."%'");
            $total = count($data);
            return view('customer.search_data', compact('data', 'total'));  
        }else{
            Redirect::route('home');
        }
              
    }

    public function search_blogCat(Request $request){
        if($request->ajax()){
            $input = $request->all();

            $data = DB::select("SELECT * FROM blogs WHERE STATUS= 1 AND title LIKE '%".$input['str']."%' OR short_description LIKE '%".$input['str']."%' OR title LIKE '%".$input['str']."%' OR long_description LIKE '%".$input['str']."%'");
            $total = count($data);
            return view('customer.searchBlogCat', compact('data','total'));  
        }else{
            Redirect::route('home');
        }
              
    }

    public function search_shopCat(Request $request){
        if($request->ajax()){
            $input = $request->all();

            $data = DB::select("SELECT * FROM products WHERE STATUS= 1 AND name LIKE '%".$input['str']."%' OR short_description LIKE '%".$input['str']."%' OR long_description LIKE '%".$input['str']."%'");
            $total = count($data);
            return view('customer.searchSlopCat', compact('data', 'total'));

        }else{
            Redirect::route('home');
        }
              
    }

    public function productRating(Request $request){

        
        $input = $request->all();        

        $input_data = json_decode($input['data']);
        
        $rating = $input_data[1]->value;
        $product_id = $input_data[2]->value;
        $comment = $input_data[3]->value;
        
        if($comment == null or $comment == '' or empty($comment)){
            return response()->json(['error' => 'Comment is requeired']);
        }
        $rating_data = RatingModel::create([
            'review_count'  => $rating,
            'customer_id'  => auth()->user()->id,
            'product_id'  => $product_id,
            'comment'  => $comment,
            
        ]);

        if($rating_data){
            return true;
        }else{
            return response()->json(['status' => '404', 'error' => 'error']);
        }

    }

    public function discountCoupon(Request $request){        

        if(!isset(auth()->user()->id)){            
            return response()->json([
                'error' => 'You need to login first'
            ]);
        }

        $input = $request->all();
        $user_id = auth()->user()->id;
        $isCouponExistInCustomer = count(OrderModel::where('customer_id', $user_id)->where('coupon', $input['coupon_code'])->get());
        
        $data = DiscountCouponModel::where('code', $input['coupon_code'])->first();    
        if(!$data){
            return response()->json([
                'error' => 'coupon is not invalid'
            ]);
        }
        if($isCouponExistInCustomer >= $data['max_uses_user']){
            return response()->json([
                'error' => 'This coupon is already used'
            ]);
        }
        
        $discount = 0;
        $starts_at = $data['starts_at'];        
        $expires_at = $data['expires_at'];
        $now = time();
       
        if(!empty($data['starts_at'])){
            if(($now >= $starts_at) < 1800) { 
                return response()->json([
                    'error' => 'coupon is not invalid'
                ]);
            }
        }

        if(!empty($data['expires_at'])){
            if(($now <= $expires_at) < 1800) { 
                return response()->json([
                    'error' => 'coupon is expired'
                ]);
            }
        }

        $discount = $data['discount_amount'];
        $type = $data['type'];        
        if($type == 'fixed'){            
            $total = Cart::total(0, '', '') - $discount;
        }

        if($type == 'percent'){          
            $discount = (Cart::subtotal(0, '', '') * $discount) / 100;
            if($discount > $data['max_amount'] ){
                $discount = $data['max_amount'];
            }

            if($discount < $data['min_amount'] ){
                $discount = $data['min_amount'];
            }

            $total = Cart::total(0, '', '')-$discount;
            
        }

        Cache::put('discount', $discount);

        Session::put([
            'total' => $total,
            'coupon' => $input['coupon_code'],
        ]);
        
        return response()->json([
            'discount_amount' => $discount,
            'total' => $total.".00"
        ]);
        
    }

    
    public function deliveryDateUpdate(Request $request){
        $input = $request->all();
        
        if(!isset($input['delivery_date'])){
            return response()->json(['message' => 'date null']);
        }

        $today = time();
        $delivery_date =strtotime($input['delivery_date']);
        if(($delivery_date - $today) < 1800) { 
            return response()->json(['error' => 'Delivery date cannot be less than today\'s date']);
        }

        $details = OrderModel::find($input['id']);
        $details->delivery_date = strtotime($input['delivery_date']);
        $details->save();

        if($details){
            return response()->json(['message' => 'Delivery Date Added']);
        }

    }
    
    
}