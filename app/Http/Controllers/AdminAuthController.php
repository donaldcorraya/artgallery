<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Session::flash('toastr_message', ['type' => 'success', 'message' => 'You have successfully logged in']);
            return redirect()->route('dashboard');
        }

        Session::flash('toastr_message', ['type' => 'error', 'message' => 'Oppes! You have entered invalid credentials']);
        return redirect()->route('admin-login');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('admin-login')->with('message','You have successfully logged out');
    }

}
