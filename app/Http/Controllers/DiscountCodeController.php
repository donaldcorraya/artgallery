<?php

namespace App\Http\Controllers;

use App\Models\DiscountCouponModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr = DiscountCouponModel::all();
        return view('admin.coupon.index', compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();        
        
        request()->validate([
            'code' => 'required',   
            'name' => 'required',   
            'max_uses' => 'required',   
            'max_uses_user' => 'required',   
            'type' => 'required',   
            'discount_amount' => 'required',   
            'min_amount' => 'required',   
            'status' => 'required',   
            'starts_at' => 'required|date',   
            'expires_at'=>'after:'.date(DATE_ATOM, time() + (5 * 60 * 60)),
            'description' => 'required'
        ]);

        DiscountCouponModel::create([
            'code' => $input['code'],   
            'name' => $input['name'],   
            'max_uses' => $input['max_uses'],   
            'max_uses_user' => $input['max_uses_user'],   
            'type' => $input['type'],   
            'discount_amount' => $input['discount_amount'],   
            'max_amount' => $input['max_amount'],   
            'min_amount' => $input['min_amount'],   
            'status' => $input['status'],   
            'starts_at' => strtotime($input['starts_at']),   
            'expires_at' => strtotime($input['expires_at']),
            'description' => $input['description']
        ]);

        return redirect('coupon')->with('flash_message' , "Added");
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arr = DiscountCouponModel::find($id);
        if (!$arr) {
            return redirect()->back();
        }
        return view('admin.coupon.show',compact('arr'));
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
        $details = DiscountCouponModel::find($id);
        $input = $request->all();        
        request()->validate([
            'code' => 'required',   
            'name' => 'required',   
            'max_uses' => 'required',   
            'max_uses_user' => 'required',   
            'type' => 'required',   
            'discount_amount' => 'required',   
            'max_amount' => 'required', 
            'min_amount' => 'required',   
            'status' => 'required',   
            'starts_at' => 'required',   
            'expires_at' => 'required',   
            'description' => 'required'
        ]);

        $details->update([
            'code' => $input['code'],   
            'name' => $input['name'],   
            'max_uses' => $input['max_uses'],   
            'max_uses_user' => $input['max_uses_user'],   
            'type' => $input['type'],   
            'discount_amount' => $input['discount_amount'],   
            'max_amount' => $input['max_amount'],   
            'min_amount' => $input['min_amount'],   
            'status' => $input['status'],   
            'starts_at' => strtotime($input['starts_at']),   
            'expires_at' => strtotime($input['expires_at']),   
            'description' => $input['description']
        ]);

        return redirect('coupon')->with('flash_message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DiscountCouponModel::find($id);

        if(file_exists($data['image'])){
            unlink($data['image']);
        }

        DiscountCouponModel::destroy($id);
        return redirect('coupon')->with('del_message', 'Deleted!');
    }
}
