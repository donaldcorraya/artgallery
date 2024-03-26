<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Wishlist;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function indexWishlist()
    {
        $wishlists = Wishlist::with(['product', 'user'])->where('user_id', auth()->user()->id)->get();
        return view('frontend.wishlist', compact('wishlists'));
    }

    public function storeWishlist($id)
    {
        $existingWishlistItem = Wishlist::where('product_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
    
        if ($existingWishlistItem) {
            if ($existingWishlistItem->wishlist_status == 1) {
                return response()->json(['status' => true, 'message']);
            } 
        }
    
        Wishlist::create(['product_id' => $id, 'wishlist_status' => 1, 'user_id' => auth()->user()->id]);
        return response()->json(['status' => true, 'message']);
    }


    public function wishlistdestroy($id=null){
        $destroyData = Wishlist::find($id);
        $destroyData->delete();
        Session::flash('msg','Data deleted successfully');
        return redirect()->route('wishlist.index');
    }


    public function customerwishlist()
    {
        $indexData['indexWishlist'] = Wishlist::join('products as p', 'wishlists.product_id', '=', 'p.id')
                                            ->where('wishlist_status', 1)
                                            ->where('user_id', auth()->user()->id)
                                            ->select('wishlists.id', 'p.slug', 'p.image', 'p.selling_price', 'p.name', 'p.size')
                                            ->get();

        return view('customer.customerWishlist', $indexData);
    }



}