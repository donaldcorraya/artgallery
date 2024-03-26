<?php

namespace App\Http\Controllers;

use App\Models\BlogCategoryModel;
use Illuminate\Http\Request;

class BlockCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr = BlogCategoryModel::all();
        return view('admin.block_category.index',compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.block_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        request()->validate([
            'name' => 'required|max:20|min:3|regex:/^[A-Za-z_-]/',
        ]);


        if(isset($input['image'])){  

            $destinationPath = 'storage/images/Blog_Categories/';
            $filename = $destinationPath.time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);
            $input['image'] = $filename;


        }else{
            $input['image'] = '';
        }

       

        unset($input['_token']);
        BlogCategoryModel::create($input);   
        return redirect('blog_category')->with('flash_message' , "Added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arr = BlogCategoryModel::find($id);
        if (!$arr) {
            return redirect()->back();
        } 
        return view('admin.block_category.show',compact('arr'));
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
        $details = BlogCategoryModel::find($id);
        $input = $request->all();
        
        if(isset($input['image'])){
            $destinationPath = 'storage/images/Blog_Categories/';
            $filename = $destinationPath.time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);
            $input['image'] = $filename;

            if(file_exists($input['old_img'])){
                unlink($input['old_img']);
            }

        }        

        request()->validate([
            'name' => 'required|max:100|min:3|regex:/^[A-Za-z_-]/', 
        ]);

        unset($input['_token']);
        unset($input['old_img']);

        $details->update($input);
        return redirect('blog_category')->with('flash_message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BlogCategoryModel::find($id);

        if(file_exists($data['image'])){
            unlink($data['image']);
        }
        
        BlogCategoryModel::destroy($id);
        return redirect('blog_category')->with('del_message', 'Deleted!');
    }
}
