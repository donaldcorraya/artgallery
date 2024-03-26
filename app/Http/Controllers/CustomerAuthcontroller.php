<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\Shipping;
use App\Models\Subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAuthcontroller extends Controller
{
    public function register()
    {
        return view('customer.create');
    }
    
    public function login()
    {
        return view('customer.index');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('login')->with('error', 'Invalid email or password');
        }
        
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(auth()->user()->role == 2){
                return redirect()->route('home');
            }else{
                Auth::logout();
                return redirect()->route('home')->with('message','You have successfully logged out');
            }
            
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'password' => 'required|min:6|confirmed'
        ]);
        DB::beginTransaction();
        try {
            $input['password'] = Hash::make($input['password']);
            $input['role'] = 2;
            $input['name'] = $request->firstName .' '. $request->lastName; 
            $user = User::create($input);
            $data = [];
            $data['firstName'] = $request->firstName;
            $data['lastName'] = $request->lastName;
            $data['email'] = $request->email;
            $data['user_id'] = $user->id;
            CustomerModel::create($data);
            
            Billing::create([
                'customer_id' => $user->id,
            ]);

            Shipping::create([
                'customer_id' => $user->id,
            ]);
            DB::commit();
            
            return redirect()->route('customer-login');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    public function subscribe_email(Request $request){

        request()->validate([
            'subscribe_email' => 'required|unique:subscribes,email', 
        ]);

        Subscribe::create([
            'email'  => $request->subscribe_email
        ]);

        return redirect('/')->with('message' , "You have successfully subscribed to our newsletter");

    }
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('home')->with('message','You have successfully logged out');
    }
}
