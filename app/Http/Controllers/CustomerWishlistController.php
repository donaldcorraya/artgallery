<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerWishlistController extends Controller
{
    public function storeWishlist($id)
    {
        dd($id);
        DB::beginTransaction();
        try {
            $userId = auth()->user()->id;
            $matchThese = ['user_id' => $userId, 'product_id' => $id];

            // Use updateOrCreate to either update the existing record or create a new one
            $wishlist = Wishlist::updateOrCreate($matchThese, [
                'user_id' => $userId,
                'product_id' => $id,
                'wishlist_status' => 1
            ]);

            DB::commit();

            return response()->json(['message' => 'Item added to Wishlist successfully']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
