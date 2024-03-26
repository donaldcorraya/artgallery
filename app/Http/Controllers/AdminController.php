<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class AdminController extends Controller
{
    public function editAdmin($id=null){
        $indexData['indexData'] = User::find($id);     
        return view('admin.admin_profile', $indexData);
    }

    public function update_profileAdmin(Request $request, $id){
        $rules = [
            'name' => 'required|string|max:55',
            'email' => 'required|string|max:55',
        ];
        $v_msg=[
            // 'logo_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);

        $data= User::find($id);
        $data->name= $request->name;
        $data->email= $request->email;
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('dashboard');
    }

    public function update_passwordAdmin(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match your actual password.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Password updated successfully!');
    }
    
}
