<?php

namespace App\Http\Controllers;

use App\Models\BLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr = BLogModel::all();
        return view('admin.blog.index',compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories_arr = DB::table('blogcategories')->where('status','=',1)->get();
        //dd($categories_arr);
        return view('admin.blog.create', compact('categories_arr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        request()->validate([
            'title' => 'required|max:100|min:3|regex:/^[A-Za-z_-]/',   
            'category_id' => 'required',
            'slug' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'required',
            'long_description' => 'required',
            'meta_title' => 'required',
            'meta_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_description' => 'required',
            'meta_keyword' => 'required'
        ]);

        /* banner */
        if(isset($input['banner'])){ 

            $destinationPath = 'storage/images/blog_banner/';
            $filename = $destinationPath.time().$request->file('banner')->getClientOriginalName();
            $request->file('banner')->move($destinationPath, $filename);
            $input['banner'] = $filename;
        }else{
            $input['banner'] = '';
        }


        /* meta_image */
        if(isset($input['meta_image'])){   

            $destinationPath = 'storage/images/meta_image/';
            $filename = $destinationPath.time().$request->file('meta_image')->getClientOriginalName();
            $request->file('meta_image')->move($destinationPath, $filename);
            $input['meta_image'] = $filename;


        }else{
            $input['meta_image'] = '';
        }

        unset($input['_token']);
        BLogModel::create($input);        
        return redirect('blog')->with('flash_message' , "Added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arr = BLogModel::find($id);
        if (!$arr) {
            return redirect()->back();
        } 
        $categories_arr = DB::table('blogcategories')->where('status','=',1)->get();
        return view('admin.blog.show',compact('arr', 'categories_arr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $details = BLogModel::find($id);
        $input = $request->all();

        
        
        if(isset($input['banner'])){
            $destinationPath = 'storage/images/blog_banner/';
            $filename = $destinationPath.time().$request->file('banner')->getClientOriginalName();
            $request->file('banner')->move($destinationPath, $filename);
            $input['banner'] = $filename;

            if(file_exists($input['old_banner'])){
                unlink($input['old_banner']);
            }

        }   
        
         /* meta_image */
         if(isset($input['meta_image'])){                 
            $destinationPath = 'storage/images/meta_image/';
            $filename = $destinationPath.time().$request->file('meta_image')->getClientOriginalName();
            $request->file('meta_image')->move($destinationPath, $filename);
            $input['meta_image'] = $filename;

            if(file_exists($input['old_meta_image'])){
                unlink($input['old_meta_image']);
            }
        }
        
        request()->validate([
            //'name' => 'required|max:100|min:3|regex:/^[A-Za-z_-]/', 
        ]);
        
        unset($input['_token']);
        unset($input['old_banner']);
        unset($input['old_meta_image']);

        $details->update($input);
        return redirect('blog')->with('flash_message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BLogModel::find($id);

        if(file_exists($data['banner'])){
            unlink($data['banner']);
        }
        
        if(file_exists($data['meta_image'])){
            unlink($data['meta_image']);
        }

        BLogModel::destroy($id);
        return redirect('blog')->with('del_message', 'Deleted!');
    }
}
