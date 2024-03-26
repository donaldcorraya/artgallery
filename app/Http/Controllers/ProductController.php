<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\RatingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr = ProductModel::with('category', 'architect')->get();
        return view('admin.product.index', compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories_arr = DB::table('categories')->where('status', '=', 1)->where('deleted_at', null)->get();
        $architect_arr = DB::table('architects')->where('status', '=', 1)->where('deleted_at', null)->get();
        return view('admin.product.create', compact('categories_arr', 'architect_arr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        request()->validate([
            'name' => 'required|max:200|min:3|regex:/^[A-Za-z_-]/',
            'size' => 'required|max:20|min:3|',
            'regular_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock_amount' => 'required|numeric',
            'short_description' => 'required',
            'long_description' => 'required',
            'slug' => 'required|unique:products',
            'product_code' => 'required|unique:products',
            'product_materials' => 'required',
            'architect_id' => 'required',
            'category_id' => 'required',
            'meta_tag' => 'required|max:200',
            'meta_description' => 'required|max:200',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:2000',
            'otherImage.*' => 'mimes:jpeg,jpg,png,gif,svg|max:10000',
        ]);

        $str = $input['name'];
        $delimiter = '-';
        $input['slug'] = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));


        if (isset($input['image'])) {
            $destinationPath = 'storage/images/Products/';
            $filename = $destinationPath . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);
            $input['image'] = $filename;
        } else {
            $input['image'] = '';
        }



        if (isset($input['otherImage'])) {
            $names = [];
            foreach ($request->file('otherImage') as $image) {
                $destinationPath = 'storage/images/other_Products/';
                $filename = $destinationPath . time() . $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                array_push($names, $filename);
            }

            $input['otherImage'] = json_encode($names);
        } else {
            $input['otherImage'] = '';
        }




        unset($input['_token']);
        ProductModel::create($input);
        return redirect('product')->with('flash_message', "Added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arr = ProductModel::find($id);
        if (!$arr) {
            return redirect()->back();
        }
        $categories_arr = DB::table('categories')->where('status', '=', 1)->where('deleted_at', null)->get();
        $architecture_arr = DB::table('architects')->where('status', '=', 1)->where('deleted_at', null)->get();

        return view('admin.product.show', compact('arr', 'categories_arr', 'architecture_arr'));
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
        $details = ProductModel::find($id);
        $input = $request->all();

        request()->validate([
            'name' => 'required|max:200|min:3|regex:/^[A-Za-z_-]/',
            'size' => 'required|max:20|min:3|',
            'regular_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock_amount' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'product_code' => 'required',
            'product_materials' => 'required',
            'architect_id' => 'required',
            'category_id' => 'required',
            'meta_tag' => 'required|max:200',
            'meta_description' => 'required|max:200',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:2000',
            'otherImage.*' => 'mimes:jpeg,jpg,png,gif,svg|max:10000',
        ]);


        if (isset($input['image'])) {

            $destinationPath = 'storage/images/Products/';
            $filename = $destinationPath . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);

            $input['image'] = $filename;

            if (file_exists($input['old_img'])) {
                unlink($input['old_img']);
            }
        }


        if (isset($input['otherImage'])) {
            if ($input['old_otherImage'] != 'null') {
                foreach (json_decode($input['old_otherImage']) as $old_other_img) {
                    if (file_exists($old_other_img)) {
                        unlink($old_other_img);
                    }
                }
            }



            $names = [];
            foreach ($request->file('otherImage') as $image) {
                $destinationPath = 'storage/images/other_Products/';
                $filename = $destinationPath . time() . $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                array_push($names, $filename);
            }

            $input['otherImage'] = json_encode($names);
        }        


        unset($input['_token']);
        unset($input['old_img']);
        unset($input['old_otherImage']);
        // unset($input['stock_amount']);

        $details->update($input);
        return redirect('product')->with('flash_message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProductModel::find($id);

        if (file_exists($data['image'])) {
            unlink($data['image']);
        }

        if (file_exists($data['otherImage'])) {
            foreach (json_decode($data['otherImage']) as $v) {
                unlink($v);
            }
        }



        ProductModel::destroy($id);
        return redirect('product')->with('del_message', 'Deleted!');
    }

    public function product_status_update(Request $request)
    {
        
        if ($request->ajax()) {
            

            $input = $request->all();

            if ($input['order_status'] == '1' || $input['order_status'] == '4') {
                
                $category = OrderModel::find($input['id']);
                $category->update([
                    'order_status' => $input['order_status'],
                ]);
                
            }
            

            if ($input['order_status'] == '3' || $input['order_status'] == '2') {
                $delivery_date = count(DB::select("SELECT delivery_date FROM orders WHERE id = ".$input['id']." AND delivery_date IS NOT NULL"));
                
                if($delivery_date){
                    $delivery_date = OrderModel::find($input['id']);
                    $delivery_date->order_status = $input['order_status'];
                    $delivery_date->save();

                }else{                    
                    
                    if($input['order_status'] == '2' || $input['order_status'] == '3'){
                        $search = OrderModel::find($input['id']);
                        if($search->order_status == 1){
                            return response()->json(['error' => 'Please set the delivery date']);
                        }else{
                            return response()->json(['error' => 'Please accept and set the delivery date']);
                        }
                        
                    }else{
                        return response()->json(['error' => 'Please set the delivery date']);
                    }
                }
                
            }


            return true;
        }
    }

    public function rating_pending()
    {
        $pending_rating = DB::select("SELECT `ratings`.`comment`, `ratings`.`created_at`, `ratings`.`review_count`, `ratings`.`status`, `ratings`.`id` FROM ratings INNER JOIN products ON ratings.product_id = products.id WHERE ratings.status= 0");
        return view('admin.rating.pending', compact('pending_rating'));
    }

    public function ratingPublishedDetails()
    { 
        $pending_rating = DB::select("SELECT `ratings`.`comment`, `ratings`.`created_at`, `ratings`.`review_count`, `ratings`.`status`, `ratings`.`id` FROM ratings INNER JOIN products ON ratings.product_id = products.id WHERE ratings.status= 1");
        return view('admin.rating.pending', compact('pending_rating'));
    }

    public function ratingHiddenDetails()
    { 
        $pending_rating = DB::select("SELECT `ratings`.`comment`, `ratings`.`created_at`, `ratings`.`review_count`, `ratings`.`status`, `ratings`.`id` FROM ratings INNER JOIN products ON ratings.product_id = products.id WHERE ratings.status= 2");
        return view('admin.rating.pending', compact('pending_rating'));
    }

    public function ratingAll()
    { 
        $pending_rating = DB::select("SELECT `ratings`.`comment`, `ratings`.`created_at`, `ratings`.`review_count`, `ratings`.`status`, `ratings`.`id` FROM ratings INNER JOIN products ON ratings.product_id = products.id");
        return view('admin.rating.pending', compact('pending_rating'));
    }

    public function ratingPendingDetails($id)
    {        
        $ratingPendingDetails = RatingModel::where("id", $id)->first();
        if (!$ratingPendingDetails) {
            return redirect()->back();
        }
        
        return view('admin.rating.ratingPendingDetails', compact('ratingPendingDetails'));
    }

    public function ratingStatusUpdate(Request $request)
    {        
        
        if ($request->ajax()) {            

            $input = $request->all();            
            $rating = RatingModel::find($input['id']);
            $rating->status = $input['status'];
            $saved = $rating->save();

            if($saved){
                return response()->json(['status' => 200, 'message' => 'Data saved successfully']);
            }else{
                return response()->json(['status' => 404, 'message' => 'Data not saved']);
            }
        }
    }
        
    
}
