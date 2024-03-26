<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(){
        $items = Menu::all();
        return view('admin.menu.index', compact('items'));
    }

    public function create(){
        $pages = Page::all();
        $items = Menu::all();
        return view('admin.menu.create', compact('pages', 'items'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            $post = Menu::create($inputs);
            DB::commit();
            return redirect()->route('menus.index')->withSuccess('Menu created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError('An error occurred: ' . $e->getMessage());
        }

    }
    
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            $post = Menu::find($id)->update($inputs);
            DB::commit();
            return redirect()->route('menus.index')->withSuccess('Menu updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError('An error occurred: ' . $e->getMessage());
        }

    }

    public function edit($id){
        $item= Menu::find($id);
        $pages = Page::all();
        $menus = Menu::all();
        if (!$item) {
            return redirect()->back();
        }
        return view('admin.menu.edit', compact('item', 'pages', 'menus'));
    }
    
    public function destroy($id){
        $item= Menu::find($id);
        $item->delete();
        return redirect()->route('menus.index')->withSuccess('Menu deleted successfully.');
    }
}