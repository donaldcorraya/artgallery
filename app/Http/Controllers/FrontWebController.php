<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\BlogCommentModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FrontWebController extends Controller
{
    public function index(){
        $items = Page::all();
        return view('admin.front.page_list', compact('items'));
    }

    public function create(){
        return view('admin.front.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }
        DB::beginTransaction();
        try {
            $inputs = $request->except('_token');
            $post = Page::create($inputs);
            DB::commit();
            return redirect()->route('pages.index')->withSuccess('Page created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError('An error occurred: ' . $e->getMessage());
        }

    }
    
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            $post = Page::find($id)->update($inputs);
            DB::commit();
            return redirect()->route('pages.index')->withSuccess('Page updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError('An error occurred: ' . $e->getMessage());
        }

    }

    public function edit($id){
        $item= Page::find($id);
        if (!$item) {
            return redirect()->back();
        }
        return view('admin.front.edit', compact('item'));
    }
    
    public function comments(){
        $items = BlogCommentModel::with(['blog', 'user'])->get();
        return view('admin.front.comments', compact('items'));
    }

    public function commentsStatusChange(Request $request, $id){
        $item = BlogCommentModel::find($id);
        $item->status = $request->status;
        $item->save();
        return redirect()->route('blog-comments')->withSuccess('Comment approved successfully.');
    }
    
    public function destroy($id){
        $item= Page::find($id);
        $item->delete();
        return redirect()->route('pages.index')->withSuccess('Page deleted successfully.');
    }

}