<?php

namespace App\Http\Controllers;

use App\Models\BlogCommentModel;
use Illuminate\Http\Request;
use Redirect;
use Session;


class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        request()->validate([
            'blog_id' => 'required',
            'user_id' => 'required',
            'comment' => 'required'
        ]);
        
        BlogCommentModel::create([
            'blog_id' => $input['blog_id'],
            'user_id' => $input['user_id'],
            'comment' => $input['comment']
        ]);      
        return Redirect::back()->with('flash_message', 'Comment added, please wait for administration approval');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
