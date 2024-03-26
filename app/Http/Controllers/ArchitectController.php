<?php

namespace App\Http\Controllers;

use App\Models\ArchitectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchitectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr = ArchitectModel::all();
        return view('admin.architect.index',compact('arr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.architect.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        request()->validate([
            'name' => 'required|max:20|min:3|regex:/^[A-Za-z_-]/',   
            'email' => 'required|unique:architects',   
            'phone' => 'required|numeric|digits_between:3,15',   
            'address' => 'required|max:100|min:3',   
            'description' => 'required|max:100|min:3',   
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2000',
        ]);


        if(isset($input['image'])){ 

            $destinationPath = 'storage/images/Architect/';
            $filename = $destinationPath.time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $filename);
            $input['image'] = $filename;


        }else{
            $input['image'] = '';
        }

        unset($input['_token']);
        ArchitectModel::create($input);        
        return redirect('architect')->with('flash_message' , "Added Architect");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $arr = ArchitectModel::find($id);
        if (!$arr) {
            abort(404, 'Architect not found.');
        }
        return view('admin.architect.show',compact('arr'));
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
        $details = ArchitectModel::find($id);
        $input = $request->all();
        
        request()->validate([
            'name' => 'required|max:100|min:3|regex:/^[A-Za-z_-]/',   
            'address' => 'required|max:100|min:3',   
            'description' => 'required|max:100|min:3',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2000',
        ]);

        if(isset($input['image'])){           
            
            $destinationPath = 'storage/images/Architect/';
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
        return redirect('architect')->with('flash_message', 'Updated Architect');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $data = ArchitectModel::find($id);

        if(file_exists($data['image'])){
            unlink($data['image']);
        }

        ArchitectModel::destroy($id);
        return redirect('architect')->with('del_message', 'Architect Deleted!');
    }
}
