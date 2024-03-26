<?php

namespace App\Providers;

use View;
use App\Models\Logo;
use App\Models\Menu;
use App\Models\User;
use App\Models\Brand;
use App\Models\Favicon;
use App\Models\BLogModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\CustomerModel;
use App\Models\BlogCategoryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        if (Schema::hasTable('application_settings')) {
            $menu = new Menu;
            $menuList = $menu->tree();
            $footer_menus = $menu->where('parent_id', '=', 0)->get();
            Paginator::useBootstrap();
            $general        = gs();
            $categories = CategoryModel::where('status', 1)->get();
            $customer_img = null;
            $categoryBar = CategoryModel::where('status', 1)->get();
            $blogCategoryBar = BlogCategoryModel::where('status', 1)->get();

            $frontArchitecture = DB::select("SELECT architects.id, architects.name, COUNT(*) AS total FROM products LEFT JOIN architects ON products.architect_id = architects.id GROUP BY architects.id");
            $productSize = ProductModel::where('status', 1)->get('size');
            $products = ProductModel::with('category', 'architect')->paginate(10);
            $brandName = Brand::latest()->paginate(4);
            $total = Cart::total();
            View::share([
                'general' => $general, 
                'menulist'=> $menuList,
                'footer_menus'=> $footer_menus,
                'categories'=> $categories,
                'customer_img'=> $customer_img,
                'categoryBar'=> $categoryBar,
                'blogCategoryBar'=> $blogCategoryBar,
                'frontArchitecture'=> $frontArchitecture,
                'productSize'=> $productSize,
                'products'=> $products,
                'brandName'=> $brandName,
                'total' => $total
            ]);
        }
        
        
        
        Paginator::useBootstrap();
    }
}
