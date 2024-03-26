<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr = CategoryModel::all();
        return view('admin.category.index',compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        //dd($input);
        request()->validate([
            'name' => 'required|max:200|min:3|regex:/^[A-Za-z_-]/',
<<<<<<< HEAD
            'slug' => 'required|max:200|min:3|unique:categories', // Ensure slug is unique
=======
            'slug' => 'required|max:200|min:3',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2000',
>>>>>>> f6d4db84aac6e6d33c58fc3ff73e905b5ce2a38e
        ]);


        if(isset($input['image'])){   

            $destinationPath = 'storage/images/Categories/';
            $filename = $destinationPath.time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);
            $input['image'] = $filename;

        }else{
            $input['image'] = '';
        }

        unset($input['_token']);
        CategoryModel::create($input);        
        return redirect('category')->with('flash_message' , "Added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arr = CategoryModel::find($id);
        if (!$arr) {
            return redirect()->back();
        }
        return view('admin.category.show',compact('arr'));
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
        $details = CategoryModel::find($id);
        $input = $request->all();

        request()->validate([
            'name' => 'required|max:100|min:3|regex:/^[A-Za-z_-]/', 
            'slug' => 'required|max:200|min:3',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:2000',
        ]);

        if(isset($input['image'])){
            $destinationPath = 'storage/images/Categories/';
            $filename = $destinationPath.time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);
            $input['image'] = $filename;

            if(file_exists($input['old_img'])){
                unlink($input['old_img']);
            }

        }  

        unset($input['_token']);
        unset($input['old_img']);

        $details->update($input);
        return redirect('category')->with('flash_message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = CategoryModel::find($id);

        if(file_exists($data['image'])){
            unlink($data['image']);
        }
        
        CategoryModel::destroy($id);
        return redirect('category')->with('del_message', 'Deleted!');
    }
}
