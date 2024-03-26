<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SliderBanner;
use App\Models\TopBanner;
use App\Models\MainBanner;
use App\Models\BottomBanner;
use App\Models\Logo;
use App\Models\Favicon;
use App\Models\Brand;
use App\Models\Meta;
use Session;

class BannerController extends Controller
{
    // ----------------------Slider Banner -------------------------------
    public function indexSliderBanner(){
        $indexData['indexData'] = SliderBanner::all();     
        return view('admin/slider_banner/index', $indexData);
    }

    public function createSliderBanner(){
        return view('admin/slider_banner/create');
    }

    public function storeSliderBanner(Request $request){
        $rules = [
            'slider_banner_title' => 'required|string|max:20',
            'slider_banner_tagline' => 'required|string|max:100',
            'slider_banner_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'slider_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);
        
        $data= new SliderBanner();
        $data->slider_banner_title= $request->slider_banner_title;
        $data->slider_banner_tagline= $request->slider_banner_tagline;

        if ($request->hasFile('slider_banner_img')) {
            $imageName = time().'.'.$request->slider_banner_img->extension();
            $request->slider_banner_img->move(public_path('images'), $imageName);
            $data->slider_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('slider_banner.index');
    }

    public function editSliderBanner($id=null){
        $indexData['indexData'] = SliderBanner::find($id); 
        if (!$indexData['indexData']) {
            return redirect()->back();
        }     
        return view('admin/slider_banner/edit', $indexData);
    }

    public function updateSliderBanner(Request $request, $id){
        $rules = [
            'slider_banner_title' => 'required|string|max:20',
            'slider_banner_tagline' => 'required|string|max:55',
            'slider_banner_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'slider_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);

        $data= SliderBanner::find($id);
        $data->slider_banner_title= $request->slider_banner_title;
        $data->slider_banner_tagline= $request->slider_banner_tagline;

        if ($request->hasFile('slider_banner_img')) {
            $imageName = time().'.'.$request->slider_banner_img->extension();
            $request->slider_banner_img->move(public_path('images'), $imageName);
            $data->slider_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('slider_banner.index');
    }

    public function showSliderBanner($id=null){
        $indexData['indexData'] = SliderBanner::find($id);  
        if (!$indexData['indexData']) {
            return redirect()->back();
        }   
        return view('admin/slider_banner/show', $indexData);
    }

    public function destroySliderBanner($id=null){
        $destroyData = SliderBanner::find($id);
        if ($destroyData->slider_banner_img) {
            $imagePath = public_path('images/') . $destroyData->slider_banner_img;
            if (file_exists($imagePath)) {
                unlink($imagePath); 
            }
        }
        $destroyData->delete();
        Session::flash('msg','Data deleted successfully');
        return redirect()->route('slider_banner.index');
    }



    // -----------------------------Top Banner ------------------------------------
    public function indexTopBanner(){
        $indexData['indexData'] = TopBanner::all();     
        return view('admin/top_banner/index', $indexData);
    }
    
    public function createTopBanner(){
        return view('admin/top_banner/create');
    }
    
    public function storeTopBanner(Request $request){
        $rules = [
            'top_banner_title' => 'required|string|max:20',
            'top_banner_tagline' => 'required|string|max:55',
            'top_banner_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'top_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);
        
        $data= new TopBanner();
        $data->top_banner_title= $request->top_banner_title;
        $data->top_banner_tagline= $request->top_banner_tagline;
    
        if ($request->hasFile('top_banner_img')) {
            $imageName = time().'.'.$request->top_banner_img->extension();
            $request->top_banner_img->move(public_path('images'), $imageName);
            $data->top_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('top_banner.index');
    }
    
    public function editTopBanner($id=null){
        $indexData['indexData'] = TopBanner::find($id);
        if (!$indexData['indexData']) {
            return redirect()->back();
        }     
        return view('admin/top_banner/edit', $indexData);
    }
    
    public function updateTopBanner(Request $request, $id){
        $rules = [
            'top_banner_title' => 'required|string|max:20',
            'top_banner_tagline' => 'required|string|max:55',
            'top_banner_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'top_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);
    
        $data= TopBanner::find($id);
        $data->top_banner_title= $request->top_banner_title;
        $data->top_banner_tagline= $request->top_banner_tagline;
    
        if ($request->hasFile('top_banner_img')) {
            $imageName = time().'.'.$request->top_banner_img->extension();
            $request->top_banner_img->move(public_path('images'), $imageName);
            $data->top_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('top_banner.index');
    }
    
    public function showTopBanner($id=null){
        $indexData['indexData'] = TopBanner::find($id);
        if (!$indexData['indexData']) {
            return redirect()->back();
        }     
        return view('admin/top_banner/show', $indexData);
    }
    
    public function destroyTopBanner($id=null){
        $destroyData = TopBanner::find($id);
        if ($destroyData->top_banner_img) {
            $imagePath = public_path('images/') . $destroyData->top_banner_img;
            if (file_exists($imagePath)) {
                unlink($imagePath); 
            }
        }
        $destroyData->delete();
        Session::flash('msg','Data deleted successfully');
        return redirect()->route('top_banner.index');
    }

    // ----------------------------------Main Banner Start ----------------------------------------
    public function indexMainBanner(){
        $indexData['indexData'] = MainBanner::all();     
        return view('admin/main_banner/index', $indexData);
    }

    public function createMainBanner(){
        return view('admin/main_banner/create');
    }

    public function storeMainBanner(Request $request){
        $rules = [
            'main_banner_title' => 'required|string|max:20',
            'main_banner_tagline' => 'required|string|max:55',
            'main_banner_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'main_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);
        
        $data= new MainBanner();
        $data->main_banner_title= $request->main_banner_title;
        $data->main_banner_tagline= $request->main_banner_tagline;

        if ($request->hasFile('main_banner_img')) {
            $imageName = time().'.'.$request->main_banner_img->extension();
            $request->main_banner_img->move(public_path('images'), $imageName);
            $data->main_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('main_banner.index');
    }

    public function editMainBanner($id=null){
        $indexData['indexData'] = MainBanner::find($id); 
        if (!$indexData['indexData']) {
            return redirect()->back();
        }    
        return view('admin/main_banner/edit', $indexData);
    }

    public function updateMainBanner(Request $request, $id){
        $rules = [
            'main_banner_title' => 'required|string|max:20',
            'main_banner_tagline' => 'required|string|max:55',
            'main_banner_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'main_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);

        $data= MainBanner::find($id);
        $data->main_banner_title= $request->main_banner_title;
        $data->main_banner_tagline= $request->main_banner_tagline;

        if ($request->hasFile('main_banner_img')) {
            $imageName = time().'.'.$request->main_banner_img->extension();
            $request->main_banner_img->move(public_path('images'), $imageName);
            $data->main_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('main_banner.index');
    }

    public function showMainBanner($id=null){
        $indexData['indexData'] = MainBanner::find($id); 
        if (!$indexData['indexData']) {
            return redirect()->back();
        }    
        return view('admin/main_banner/show', $indexData);
    }

    public function destroyMainBanner($id=null){
        $destroyData = MainBanner::find($id);
        if ($destroyData->main_banner_img) {
            $imagePath = public_path('images/') . $destroyData->main_banner_img;
            if (file_exists($imagePath)) {
                unlink($imagePath); 
            }
        }
        $destroyData->delete();
        Session::flash('msg','Data deleted successfully');
        return redirect()->route('main_banner.index');
    }


    // ----------------------Bottom Banner -------------------------------
    public function indexBottomBanner(){
        $indexData['indexData'] = BottomBanner::all();     
        return view('admin/bottom_banner/index', $indexData);
    }

    public function createBottomBanner(){
        return view('admin/bottom_banner/create');
    }

    public function storeBottomBanner(Request $request){
        $rules = [
            'bottom_banner_title' => 'required|string|max:20',
            'bottom_banner_tagline' => 'required|string|max:100',
            'bottom_banner_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'bottom_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);
        
        $data= new BottomBanner();
        $data->bottom_banner_title= $request->bottom_banner_title;
        $data->bottom_banner_tagline= $request->bottom_banner_tagline;

        if ($request->hasFile('bottom_banner_img')) {
            $imageName = time().'.'.$request->bottom_banner_img->extension();
            $request->bottom_banner_img->move(public_path('images'), $imageName);
            $data->bottom_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('bottom_banner.index');
    }

    public function editBottomBanner($id=null){
        $indexData['indexData'] = BottomBanner::find($id);
        if (!$indexData['indexData']) {
            return redirect()->back();
        }     
        return view('admin/bottom_banner/edit', $indexData);
    }

    public function updateBottomBanner(Request $request, $id){
        $rules = [
            'bottom_banner_title' => 'required|string|max:20',
            'bottom_banner_tagline' => 'required|string|max:55',
            'bottom_banner_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $v_msg=[
            // 'bottom_banner_img.required'=> 'Please enter Name',
        ];
        $this -> validate($request, $rules, $v_msg);

        $data= BottomBanner::find($id);
        $data->bottom_banner_title= $request->bottom_banner_title;
        $data->bottom_banner_tagline= $request->bottom_banner_tagline;

        if ($request->hasFile('bottom_banner_img')) {
            $imageName = time().'.'.$request->bottom_banner_img->extension();
            $request->bottom_banner_img->move(public_path('images'), $imageName);
            $data->bottom_banner_img = $imageName;
        }
        $data->save();
        Session::flash('msg','Data submit successfully');
        return redirect()->route('bottom_banner.index');
    }

    public function showBottomBanner($id=null){
        $indexData['indexData'] = BottomBanner::find($id);
        if (!$indexData['indexData']) {
            return redirect()->back();
        }     
        return view('admin/bottom_banner/show', $indexData);
    }

    public function destroyBottomBanner($id=null){
        $destroyData = BottomBanner::find($id);
        if ($destroyData->bottom_banner_img) {
            $imagePath = public_path('images/') . $destroyData->bottom_banner_img;
            if (file_exists($imagePath)) {
                unlink($imagePath); 
            }
        }
        $destroyData->delete();
        Session::flash('msg','Data deleted successfully');
        return redirect()->route('bottom_banner.index');
    }


    
        // ----------------------Brand Name -------------------------------

        public function indexBrand(){
            $indexData['indexData'] = Brand::all();     
            return view('admin/brand/index', $indexData);
        }
        
        public function createBrand(){
            return view('admin/brand/create');
        }
        
        public function storeBrand(Request $request){
            $rules = [
                'brand_tagline' => 'required|string|max:100',
                'brand_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
            $v_msg=[
                // 'brand_img.required'=> 'Please enter Name',
            ];
            $this -> validate($request, $rules, $v_msg);
            
            $data= new Brand();
            $data->brand_tagline= $request->brand_tagline;
        
            if ($request->hasFile('brand_img')) {
                $imageName = time().'.'.$request->brand_img->extension();
                $request->brand_img->move(public_path('images'), $imageName);
                $data->brand_img = $imageName;
            }
            $data->save();
            Session::flash('msg','Data submit successfully');
            return redirect()->route('brand.index');
        }
        
        public function editBrand($id=null){
            $indexData['indexData'] = Brand::find($id);  
            if (!$indexData['indexData']) {
                return redirect()->back();
            }   
            return view('admin/brand/edit', $indexData);
        }
        
        public function updateBrand(Request $request, $id){
            $rules = [
                'brand_tagline' => 'required|string|max:55',
                'brand_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
            $v_msg=[
                // 'brand_img.required'=> 'Please enter Name',
            ];
            $this -> validate($request, $rules, $v_msg);
        
            $data= Brand::find($id);
            $data->brand_tagline= $request->brand_tagline;
        
            if ($request->hasFile('brand_img')) {
                $imageName = time().'.'.$request->brand_img->extension();
                $request->brand_img->move(public_path('images'), $imageName);
                $data->brand_img = $imageName;
            }
            $data->save();
            Session::flash('msg','Data submit successfully');
            return redirect()->route('brand.index');
        }
        
        public function showBrand($id=null){
            $indexData['indexData'] = Brand::find($id);  
            if (!$indexData['indexData']) {
                return redirect()->back();
            }   
            return view('admin/brand/show', $indexData);
        }
        
        public function destroybrand($id=null){
            $destroyData = Brand::find($id);
            if ($destroyData->brand_img) {
                $imagePath = public_path('images/') . $destroyData->brand_img;
                if (file_exists($imagePath)) {
                    unlink($imagePath); 
                }
            }
            $destroyData->delete();
            Session::flash('msg','Data deleted successfully');
            return redirect()->route('brand.index');
        }
        
}

    