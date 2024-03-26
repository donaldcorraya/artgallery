<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontWebController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ArchitectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerAuthcontroller;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\BlockCategoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\LangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/  


//-------------------- Frontend Routes ----------------------------------------

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/shop', [FrontendController::class, 'products'])->name('shop');
Route::get('shop/{slug}', [FrontendController::class, 'product_details'])->name('shop.details');
// Route::get('shop/filter/product', [FrontendController::class, 'filter'])->name('shop.filter');
Route::get('/blogs', [FrontendController::class, 'front_blogs'])->name('front.blogs');
Route::get('/blogs/{slug}', [FrontendController::class, 'front_blog_details'])->name('front.blogsDetails');
Route::get('cart/', [CartController::class, 'cart'])->name('front.cart');
Route::get('product-by-category/{id}', [FrontendController::class, 'productCategory'])->name('product-by-category');
Route::get('blog/category/{id}', [FrontendController::class, 'blog_category'])->name('front.blog.category');
Route::get('architect_id_ajax/', [FrontendController::class, 'architect_id_ajax'])->name('front.architect_id_ajax');
Route::post('add-to-cart/', [CartController::class, 'addToCart'])->name('front.addToCard');
Route::post('update-cart/', [CartController::class, 'updateCart'])->name('front.updateCart');
Route::post('deleteItem/', [CartController::class, 'deleteItem'])->name('front.deleteItem');
Route::post('addToCartWithQty/', [CartController::class, 'addToCartWithQty'])->name('front.addToCartWithQty');
Route::get('search_data/', [CustomerController::class, 'search_ajax'])->name('front.search_ajax');
Route::get('search_blogCat/', [CustomerController::class, 'search_blogCat'])->name('front.search_blogCat');
Route::get('search_shopCat/', [CustomerController::class, 'search_shopCat'])->name('front.search_shopCat');

Route::get('get-cart-details', [CartController::class, 'getCartDetails'])->name('get-cart-details');
Route::get('remove-cart-item/{id}', [CartController::class, 'removeItem'])->name('remove-cart-item');

Route::get('/front-pages/{slug}', [PageController::class, 'show']);
Route::post('/customer-logout', [CustomerAuthcontroller::class, 'logout'])->name('customer-logout');
Route::post('/admin-logout', [AdminAuthController::class, 'logout'])->name('admin-logout');

Route::post('/subscribe-email', [CustomerAuthcontroller::class, 'subscribe_email'])->name('subscribe_email');

Route::middleware(['guest'])->group(function () {
    /******** Admin Routes *********/
    Route::get('/admin-login', [AdminAuthController::class, 'index'])->name('admin-login');
    Route::post('/admin-post-login', [AdminAuthController::class, 'postLogin'])->name('admin-post-login');

    /******** Customer auth Routes *********/
    Route::get('/customer-login', [CustomerAuthcontroller::class, 'login'])->name('customer-login');
    Route::post('/customer-post-login', [CustomerAuthcontroller::class, 'postLogin'])->name('customer-post-login');
    Route::post('/customer-registraion', [CustomerAuthcontroller::class, 'store'])->name('customer-registraion');
    Route::get('/register', [CustomerAuthcontroller::class, 'register'])->name('customer.register');

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.request');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

//-------------------- Customer Routes ----------------------------------------
Route::middleware('customerAuth')->group(function(){
    Route::get('/customer_dashboard', [CustomerController::class, 'customerDashboard'])->name('customer_dashboard');
    Route::get('checkout/', [CartController::class, 'checkout'])->name('front.checkout');
    Route::put('confirmed_order/{id}', [CartController::class, 'order'])->name('customer.order');
    Route::get('customer_order/', [CustomerController::class, 'customer_order'])->name('customer.order.dashboard');
    Route::get('order_details/{id}', [CustomerController::class, 'orderDetails'])->name('front.orderDetails');
    Route::post('productRating/', [CustomerController::class, 'productRating'])->name('product.rating');
    Route::post('discount-coupon/', [CustomerController::class, 'discountCoupon'])->name('discount.coupon');
    Route::post('submit.rating', [RatingController::class, 'store'])->name('submit.rating');

    Route::get('rating/index', [RatingController::class, 'indexrating'])->name('index.rating');

    Route::get('wishlist',[WishlistController::class, 'indexWishlist'])->name('wishlist.index');
    Route::get('wishlist/{id}',[WishlistController::class,'storeWishlist'])->name('wishlist.store');
    Route::get('wishlist/destroy/{id}',[WishlistController::class,'wishlistdestroy'])->name('wishlist.destroy');

    Route::get('customer/wishlist',[WishlistController::class, 'customerwishlist'])->name('customer_wishlist.index');
    Route::get('customer/wishlist/destroy/{id}',[WishlistController::class,'customerwishlistdestroy'])->name('customer_wishlist.destroy');


    Route::get('shipping/index',[ShippingController::class, 'indexshipping'])->name('shipping.index');
    Route::put('shipping/update/',[ShippingController::class,'updateshipping'])->name('shipping.update');
    
    Route::get('billing/index',[BillingController::class, 'indexbilling'])->name('billing.index');
    Route::put('billing/update/',[BillingController::class,'updatebilling'])->name('billing.update');

    Route::post('blog-comment', [BlogCommentController::class, 'store'])->name('blog-comment');

    Route::get('/order_completed', [CustomerController::class, 'order_completed'])->name('order_completed');
});

Route::middleware(['admin','auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');    
    Route::resource('product', ProductController::class);
    Route::resource('architect', ArchitectController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('blog_category', BlockCategoryController::class);
    Route::get('adminCustomerOrders/', [CustomerController::class, 'adminCustomerOrders'])->name('front.adminCustomerOrders');
    Route::get('orderPending/', [CustomerController::class, 'orderPending'])->name('front.adminCustomerOrders.pending');
    Route::get('orderAccepted/', [CustomerController::class, 'orderAccepted'])->name('front.adminCustomerOrders.accepted');
    Route::get('orderDelivered/', [CustomerController::class, 'orderDelivered'])->name('front.adminCustomerOrders.delivered');
    Route::get('orderConfirmed/', [CustomerController::class, 'orderConfirmed'])->name('front.adminCustomerOrders.confirmed');
    Route::get('orderCancelled/', [CustomerController::class, 'orderCancelled'])->name('front.adminCustomerOrders.cancelled');
    Route::get('adminOrderDetails/{id}', [CustomerController::class, 'adminOrderDetails'])->name('front.adminOrderDetails');
    Route::post('product_status_update/', [ProductController::class, 'product_status_update'])->name('product_status_update');
    Route::get('deliveryStatus/', [CustomerController::class, 'deliveryStatus'])->name('front.deliveryStatus');
    Route::get('ratingPending/', [ProductController::class, 'rating_pending'])->name('rate.pending');
    Route::get('ratingPendingDetails/{id}', [ProductController::class, 'ratingPendingDetails'])->name('rate.pendingDetails');
    Route::get('ratingPublishedDetails/', [ProductController::class, 'ratingPublishedDetails'])->name('rate.publishedDetails');
    Route::get('ratingAll/', [ProductController::class, 'ratingAll'])->name('rate.all');
    Route::get('ratingHiddenDetails/', [ProductController::class, 'ratingHiddenDetails'])->name('rate.hiddenDetails');
    Route::post('ratingStatusUpdate', [ProductController::class, 'ratingStatusUpdate'])->name('rating.status.update');
    Route::resource('coupon', DiscountCodeController::class);
    Route::delete('/orders/{id}', [CustomerController::class, 'delete'])->name('orders.delete');


    Route::post('delivery-date-update/', [CustomerController::class, 'deliveryDateUpdate'])->name('delivery-date-update');
    Route::get('export-sell-report', [PdfController::class, 'saleReport'])->name('export-sell-report');
    Route::get('export-order-report', [PdfController::class, 'orderReport'])->name('export-order-report');
    Route::get('export-wishlist-report', [PdfController::class, 'wishlist'])->name('export-wishlist-report');
    Route::get('export-delivery-report', [PdfController::class, 'delivery'])->name('export-delivery-report');

    Route::get('pages', [FrontWebController::class, 'index'])->name('pages.index');
    Route::get('page-create', [FrontWebController::class, 'create'])->name('pages.create');
    Route::get('page-edit/{id}', [FrontWebController::class, 'edit'])->name('pages.edit');
    Route::get('page-delete/{id}', [FrontWebController::class, 'destroy'])->name('pages.destroy');
    Route::put('page-update/{id}', [FrontWebController::class, 'update'])->name('pages.update');
    Route::post('page-store', [FrontWebController::class, 'store'])->name('pages.store');

    Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('menus-create', [MenuController::class, 'create'])->name('menus.create');
    Route::get('menus-edit/{id}', [MenuController::class, 'edit'])->name('menus.edit');
    Route::get('menus-delete/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::put('menus-update/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::post('menus-store', [MenuController::class, 'store'])->name('menus.store');

    // comments list 
    Route::get('blog-comments', [FrontWebController::class, 'comments'])->name('blog-comments');
    Route::post('change-comment-status/{id}', [FrontWebController::class, 'commentsStatusChange'])->name('change-comment-status');

    Route::middleware(['admin'])->prefix('application-setting')->group(function() {
        Route::get('/setting', [SettingController::class, 'index'])->name('setting');
        Route::get('/cache-clear', [SettingController::class, 'cachClear'])->name('cache-clear');
        Route::get('/email-setting', [SettingController::class, 'emailSetting'])->name('email-setting');
        Route::get('/send-test-email', [SettingController::class, 'emailTesting'])->name('send-test-email');
        Route::post('/setting-update', [SettingController::class, 'update'])->name('setting-update');
        Route::post('/email-setting-update', [SettingController::class, 'emailSettingUpdate'])->name('email-setting-update');
        Route::get('application-cache-clear', [SettingController::class, 'cachClear'])->name('application-cache-clear');
        Route::get('seo-setting', [SettingController::class, 'seoSetting'])->name('seo-setting');
        Route::post('seo-setting-update', [SettingController::class, 'updateSeoSetting'])->name('seo-setting-update');
        Route::get('footer-setting', [SettingController::class, 'footerSetting'])->name('footer-setting');
        Route::put('footer-update/{id}', [SettingController::class, 'footerUpdate'])->name('footer-update');    
        Route::get('tax', [SettingController::class, 'tax'])->name('tax');
        Route::put('tax-update/{id}', [SettingController::class, 'taxUpdate'])->name('tax-update');
    });


    Route::resource('customer', CustomerController::class);

    //-------------------- Frontend Routes ----------------------------------------
    //-------------------- Backend Routes ----------------------------------------

    Route::get('slider_banner/index',[BannerController::class, 'indexSliderBanner'])->name('slider_banner.index');
    Route::get('slider_banner/insert',[BannerController::class,'createSliderBanner'])->name('slider_banner.create');
    Route::post('slider_banner/insert',[BannerController::class,'storeSliderBanner'])->name('slider_banner.store');
    Route::get('slider_banner/update/{id}',[BannerController::class,'editSliderBanner'])->name('slider_banner.edit');
    Route::put('slider_banner/update/{id}',[BannerController::class,'updateSliderBanner'])->name('slider_banner.update');
    Route::get('slider_banner/show/{id}',[BannerController::class,'showSliderBanner'])->name('slider_banner.show');
    Route::get('slider_banner/destroy/{id}',[BannerController::class,'destroySliderBanner'])->name('slider_banner.destroy');

    Route::get('top_banner/index',[BannerController::class, 'indexTopBanner'])->name('top_banner.index');
    Route::get('top_banner/insert',[BannerController::class,'createTopBanner'])->name('top_banner.create');
    Route::post('top_banner/insert',[BannerController::class,'storeTopBanner'])->name('top_banner.store');
    Route::get('top_banner/update/{id}',[BannerController::class,'editTopBanner'])->name('top_banner.edit');
    Route::put('top_banner/update/{id}',[BannerController::class,'updateTopBanner'])->name('top_banner.update');
    Route::get('top_banner/show/{id}',[BannerController::class,'showTopBanner'])->name('top_banner.show');
    Route::get('top_banner/destroy/{id}',[BannerController::class,'destroyTopBanner'])->name('top_banner.destroy');

    Route::get('main_banner/index',[BannerController::class, 'indexMainBanner'])->name('main_banner.index');
    Route::get('main_banner/insert',[BannerController::class,'createMainBanner'])->name('main_banner.create');
    Route::post('main_banner/insert',[BannerController::class,'storeMainBanner'])->name('main_banner.store');
    Route::get('main_banner/update/{id}',[BannerController::class,'editMainBanner'])->name('main_banner.edit');
    Route::put('main_banner/update/{id}',[BannerController::class,'updateMainBanner'])->name('main_banner.update');
    Route::get('main_banner/show/{id}',[BannerController::class,'showMainBanner'])->name('main_banner.show');
    Route::get('main_banner/destroy/{id}',[BannerController::class,'destroyMainBanner'])->name('main_banner.destroy');

    Route::get('bottom_banner/index',[BannerController::class, 'indexBottomBanner'])->name('bottom_banner.index');
    Route::get('bottom_banner/insert',[BannerController::class,'createBottomBanner'])->name('bottom_banner.create');
    Route::post('bottom_banner/insert',[BannerController::class,'storeBottomBanner'])->name('bottom_banner.store');
    Route::get('bottom_banner/update/{id}',[BannerController::class,'editBottomBanner'])->name('bottom_banner.edit');
    Route::put('bottom_banner/update/{id}',[BannerController::class,'updateBottomBanner'])->name('bottom_banner.update');
    Route::get('bottom_banner/show/{id}',[BannerController::class,'showBottomBanner'])->name('bottom_banner.show');
    Route::get('bottom_banner/destroy/{id}',[BannerController::class,'destroyBottomBanner'])->name('bottom_banner.destroy');

    Route::get('brand/index',[BannerController::class, 'indexBrand'])->name('brand.index');
    Route::get('brand/insert',[BannerController::class,'createBrand'])->name('brand.create');
    Route::post('brand/insert',[BannerController::class,'storeBrand'])->name('brand.store');
    Route::get('brand/update/{id}',[BannerController::class,'editBrand'])->name('brand.edit');
    Route::put('brand/update/{id}',[BannerController::class,'updateBrand'])->name('brand.update');
    Route::get('brand/show/{id}',[BannerController::class,'showBrand'])->name('brand.show');
    Route::get('brand/destroy/{id}',[BannerController::class,'destroyBrand'])->name('brand.destroy');

    Route::get('sales/report',[ReportController::class,'salesReport'])->name('sales.report');
    Route::post('all/sales/invoice/', [ReportController::class, 'all_salesReport'])->name('all_sales.invice');

    Route::get('order/report',[ReportController::class,'orderReport'])->name('order.report');
    Route::post('order/report/filter',[ReportController::class,'invioceOrder'])->name('order.invioce');
    Route::get('order/invoice/{id}', [ReportController::class, 'invoiceOrderDetails'])->name('order_details.invoice');

    Route::get('report/wishlist',[ReportController::class,'wishlistReport'])->name('wishlist.report');
    Route::post('invioce/customer/wishlist',[ReportController::class,'customerWishlistInvioce'])->name('customer.wishlist.report');


    Route::get('delivery/report',[ReportController::class,'deliveryReport'])->name('delivery.report');
    Route::post('delivery/invioce',[ReportController::class,'deliveryInvioce'])->name('delivery.invioce');

    Route::get('admin/profile/{id}',[AdminController::class,'editAdmin'])->name('admin.edit');
    Route::put('admin/profile/{id}',[AdminController::class,'update_profileAdmin'])->name('admin_profile.update');
    Route::post('admin/password',[AdminController::class,'update_passwordAdmin'])->name('admin_password.update');
});


Route::resource('customer', CustomerController::class);
Route::post('/customer-login',[CustomerController::class,'customerLogin'])->name('customer.login');


Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');


    





    