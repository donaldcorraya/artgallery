<?php

namespace App\Http\Controllers;

use App\Models\RatingModel;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $matchThese = ['product_id'=> $validatedData['product_id'], 'user_id'=> auth()->id()];
        RatingModel::updateOrCreate($matchThese,[
            'product_id' => $validatedData['product_id'],
            'user_id' => auth()->id(),
            'review_count' => $validatedData['rating'],
            'comment' => $validatedData['review'],
        ]);

        return redirect()->back()->with('success', 'Rating submitted successfully!');
    }

    public function indexrating(){
        $indexData['rating'] = RatingModel::where('user_id','=', auth()->user()->id)->get();
        return view('customer/rating', $indexData);
    }
}
