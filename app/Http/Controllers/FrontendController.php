<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BLogModel;
use App\Models\TopBanner;
//use Illuminate\Support\Facades\Request;
use App\Models\MainBanner;
use App\Models\OrderModel;
use App\Models\RatingModel;
use App\Models\BottomBanner;
use App\Models\ProductModel;
use App\Models\SliderBanner;
use Illuminate\Http\Request;
use App\Models\BlogCommentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    private $per_page = 9;

    public function index(){
        $indexData['sliderBanner'] = SliderBanner::latest()->paginate(3); 
        $indexData['topBanner'] = TopBanner::orderBy('id', 'desc')->paginate(2); 
        $indexData['mainBanner'] = MainBanner::orderBy('id', 'desc')->paginate(1);
        $indexData['bottomBanner'] = BottomBanner::orderBy('id', 'desc')->paginate(2);          
        $indexData['bestSeller'] = ProductModel::orderBy('id', 'desc')->paginate(20);          
        $indexData['newProduct'] = ProductModel::orderBy('id', 'desc')->paginate(8);
        // $indexData['paintings']= ProductModel::where('category_id','=',1)->paginate(4);     
        // $indexData['sculptures']= ProductModel::where('category_id','=',2)->paginate(4);     
        // $indexData['graphics']= ProductModel::where('category_id','=',8)->paginate(4); 
        return view('frontend.home', $indexData);
    }

    public function products(){
        $arr = ProductModel::orderBy('id', 'DESC')->paginate($this->per_page);    
        $total_products = count(ProductModel::orderBy('id', 'DESC')->get());
        
        return view('frontend.products', compact('arr', 'total_products'));
    }

    public function product_details($slug){
        $product = ProductModel::with('category', 'architect')->where('slug', $slug)->first();
        if(!$product){
            return back()->with('flash_error','Product not found');
        }

        $other_images = json_decode($product['otherImage']);
        $calculated = ($product['selling_price']-$product['regular_price'])/$product['regular_price'] * 100;
        $percentage = number_format($calculated,2);
        $related_product = ProductModel::where('category_id', $product->category->id)->get();
        $ratings = RatingModel::where('status', 1)->where('product_id', $product->id)->get();
        return view('frontend.products_details', compact('product', 'other_images', 'percentage', 'related_product', 'ratings'));
    }

    public function order(){
        return view('frontend.order');
    }

    public function front_blogs(){        
        $arr = BLogModel::where('status', '=', 1)->paginate(9);   
        $recentPost = BLogModel::where('status', 1)->orderBy('id', 'DESC')->paginate(8);
        return view('frontend.blog',compact('arr', 'recentPost'));
    }
    public function front_blog_details($slug){ 
        $current_blog = BLogModel::where('slug', $slug)->first();
        $related_blog = BLogModel::where('category_id', $current_blog['category_id'])
            ->where('slug', '!=', $slug)
            ->get();
        $recentPost = BLogModel::where('status', 1)->orderBy('id', 'DESC')->paginate(8);

        $comment = DB::table('blog_comments')
            ->select('*')
            ->join('users', 'users.id', '=', 'blog_comments.user_id')
            ->where('blog_comments.blog_id', $current_blog['id'])
            ->where('blog_comments.status', 1)
            ->get();
          
        return view('frontend.blogDetails',compact('current_blog', 'related_blog', 'comment', 'recentPost'));
    }   
    
    public function productCategory($id){
        $arr = ProductModel::where('category_id', '=', $id)->paginate(9); 
        $total_products = count($arr);
        
        return view('frontend.products',compact('arr', 'total_products'));
    }

    public function blog_category($id){        
        $arr = BLogModel::where('category_id', '=', $id)->where('status', '=', 1)->paginate(9); 
        $total_products = $arr->count();
        $cat_id = $id;

        $emptyData = '';
        if($total_products < 1){
            $emptyData = 'No data found';
        }
        $recentPost = BLogModel::where('status', 1)->orderBy('id', 'DESC')->paginate(8);
        return view('frontend.blog',compact('arr', 'total_products', 'cat_id', 'emptyData', 'recentPost'));
    }

    public function architect_id_ajax(Request $request){
        $input = $request->all();
        $order_type = '';
        $min = '';
        $max = '';
        $ids = array();

        if(isset($input['id'])){
            $architect_ids = json_decode($input['id']); 
        }
        

        $type = $input['type'];        
        $arr = array();
        $total_products = 0;
        
        $page = 1;

        if(isset($input['page'])){                      
            $page = $input['page'];
        }

        $offset = ($page - 1)* $this->per_page;

        if(isset($input['cat_id'])){    

            $cat_id = $input['cat_id'];
            foreach($architect_ids as $architect_itm){
                array_push($arr, ProductModel::where('architect_id', $architect_itm)->where('category_id', $cat_id)->paginate($this->per_page));
            }

        }

        elseif($input['type'] == 2){
            foreach($architect_ids as $architect_itm){ 
                $arr = DB::select("SELECT `products`.`id`, `products`.`name`,`products`.`size`, products.`image`, `products`.`slug`, `products`.`selling_price` FROM products INNER JOIN `categories` ON `products`.`category_id` = `categories`.`id` WHERE products.`category_id` = $architect_itm LIMIT $this->per_page OFFSET $offset ");
                $total_products = DB::select("SELECT count(products.id) as total_data FROM products INNER JOIN `categories` ON `products`.`category_id` = `categories`.`id` WHERE products.`category_id` = $architect_itm");
                $total_products = $total_products[0]->total_data;
            }
        } 
        
        elseif($input['type'] == 3){
            
            if($input['order_type'] == 1){
                
                $arr = DB::select('SELECT * FROM `products` ORDER BY id DESC LIMIT '.$this->per_page.' OFFSET '.$offset.' ');
                $total_products = DB::select("SELECT count(id) as total_data FROM `products` ");
                $order_type = $input['order_type'];
                
            }

            if($input['order_type'] == 4){
                $arr = DB::select('SELECT * FROM `products` ORDER BY selling_price ASC LIMIT '.$this->per_page.' OFFSET '.$offset.' ');
                $total_products = DB::select("SELECT count(id) as total_data FROM `products` ");
                $order_type = $input['order_type'];
            }
            
           
            $total_products = $total_products[0]->total_data;

            


        }elseif($input['type'] == 4){  

            $arr = DB::select('SELECT * FROM `products` WHERE `selling_price` BETWEEN '.$input['min'].' AND '.$input['max'].' ORDER BY `selling_price`  LIMIT '.$this->per_page.' OFFSET '.$offset.'');
            $total_products = DB::select('SELECT count(id) as total_data FROM `products` WHERE `selling_price` BETWEEN '.$input['min'].' AND '.$input['max'].' ');
            $min = $input['min'];
            $max = $input['max'];
            $total_products = $total_products[0]->total_data;

           
        }       
        
        else{
            
            foreach($architect_ids as $architect_itm){ 
                $arr = DB::select('SELECT * FROM `products` WHERE `architect_id` IN (' . implode(',', array_map('intval', $architect_ids)) .') LIMIT '.$this->per_page.' OFFSET '.$offset.' ');
                $total_products = DB::select('SELECT count(id) as total_data FROM `products`  WHERE `architect_id` IN (' . implode(',', array_map('intval', $architect_ids)) . ')');
                $total_products = $total_products[0]->total_data;
            }
        }    
        
        $total_pages = ceil($total_products/$this->per_page);        
        
        return view('frontend.architect',compact('arr', 'total_products', 'page' ,'total_pages', 'offset', 'type', 'order_type', 'min', 'max'));

    }

    public function filter(){     
        
        $page = 1;
        $per_page = $this->per_page;
        $offset = ($page -1)*$per_page;

        if($_GET['max'] and $_GET['min']){
            $arr = ProductModel::where('selling_price', '>=', $_GET['min'])
                                    ->where('selling_price', '<=', $_GET['max'] )
                                    ->skip($offset)->take($per_page)->paginate($per_page);  
                                    $total_products =  count($arr);
        }

        if(($_GET['max']) && !$_GET['min']){
            $arr = ProductModel::where('selling_price', '<=', $_GET['max'] )
                                    ->skip($offset)->take($per_page)->paginate($per_page); 
                                    $total_products =  count($arr); 
        }

        if($_GET['min'] && !$_GET['max']){            
            $arr = ProductModel::where('selling_price', '>=', $_GET['min'] )
                                    ->skip($offset)->take($per_page)->paginate($per_page);                                    
                                    $total_products =  count($arr);
        }

        if(!$_GET['max'] && !$_GET['min']){
            return redirect()->route('shop');
        }

        $total_page = ceil($total_products/$per_page);
        
               
        return view('frontend.productsFilter', compact('arr', 'total_products', 'per_page', 'total_page', 'page'));
    }

}
