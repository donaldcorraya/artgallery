<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Wishlist;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ReportController extends Controller
{
    public function salesReport(){
        $from = null;
        $to = null;
        $salesReport = [];
        return view('admin.report_invoice.sales_report', compact('from', 'to', 'salesReport'));
    }

    public function all_salesReport(Request $request)
    {
        $request->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date',
        ]);

        $from = $request->input('fromdate');
        $to = $request->input('todate');
        
        $sellQuery = OrderModel::query()
            ->with(['customer'])
            ->where('order_status', 3); // Moved this condition here
        
        if ($from && $to) {
            $sellQuery->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
        }

        $salesReport = $sellQuery->get();
        
        Cache::put('from', $from);
        Cache::put('to', $to);

        return view('admin.report_invoice.sales_report', compact('salesReport', 'from', 'to'));
    }

    
    public function orderReport(){
        $salesReport = OrderModel::join('customers', 'orders.customer_id', '=', 'customers.user_id')
        ->select('orders.id','orders.order_status', 'customers.firstName', 'customers.lastName', 'customers.phone', 'orders.order_total', 'orders.payment_method')
        ->get();
        $from = null;
        $to = null;
        $salesReport = [];
        return view('admin.report_invoice.order_report', compact('from', 'to', 'salesReport'));
    }

    public function invioceOrder(Request $request)
    {
        $request->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date',
        ]);

        $from = $request->input('fromdate');
        $to = $request->input('todate');
        
        $sellQuery = OrderModel::query()
            ->with(['customer'])
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to);

        if ($request->status) {
            $sellQuery->where('order_status', $request->status);
        }

        $orderReport = $sellQuery->get();
        
        Cache::put('from', $from);
        Cache::put('to', $to);
        Cache::put('status', $request->status);

        return view('admin.report_invoice.order_report', compact('orderReport', 'from', 'to'));
    }

    public function invoiceOrderDetails($id)
    {
        $indexReport['orderReport'] = OrderModel::join('customers', 'orders.customer_id', '=', 'customers.user_id')
            ->select('orders.id', 'orders.created_at', 'orders.order_total', 'orders.tax_total', 'orders.payment_method', 'orders.delivery_address', 'orders.payment_method',  'orders.product_arr', 'orders.shipping', 'orders.billing',
                'customers.firstName', 'customers.lastName', 'customers.phone', 'customers.email', 'customers.street_address', 'customers.city', 'customers.state')
            ->find($id);

        if (!$indexReport['orderReport']) {
            return abort(404);
        }

        $productArr = json_decode($indexReport['orderReport']->product_arr, true);
        $indexReport['productArr'] = $productArr;

        $shipping = json_decode($indexReport['orderReport']->shipping, true);
        $indexReport['shipping'] = $shipping;

        $billing = json_decode($indexReport['orderReport']->billing, true);
        $indexReport['billing'] = $billing;

        if (json_last_error() !== JSON_ERROR_NONE) {
            $indexReport['productArr'] = [];
            $indexReport['shipping'] = [];
            $indexReport['billing'] = [];
        }

        $indexReport['companyinfo'] = ApplicationSetting::all();
        return view('admin.report_invoice.invoice_order', $indexReport);
    }


    public function wishlistReport(){
        $from = null;
        $to = null;
        $wishlistReport = [];
        return view('admin.report_invoice.wishlist_report', compact('from', 'to', 'wishlistReport'));
    }


    public function customerWishlistInvioce(Request $request){
        $request->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date',
        ]);

        $from = $request->input('fromdate');
        $to = $request->input('todate');
        
        $sellQuery = Wishlist::query();
        
        if ($from && $to) {
            $sellQuery->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
        }

        $wishlistReport = $sellQuery->with(['user', 'product'])->get();

        Cache::put('from', $from);
        Cache::put('to', $to);
        Cache::put('status', $request->status);

        return view('admin.report_invoice.wishlist_report', compact('wishlistReport', 'from', 'to'));
    }


    public function deliveryReport(){
        $from = null;
        $to = null;
        $wishlistReport = [];
        return view('admin.report_invoice.delivery_report', compact('wishlistReport', 'from', 'to'));
    }

    public function deliveryInvioce(Request $request)
    {
        $request->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date',
        ]);

        $from = $request->input('fromdate');
        $to = $request->input('todate');
        
        $sellQuery = OrderModel::query()
        ->with(['customer'])
        ->where('order_status', 2); // Moved this condition here

        if ($from && $to) {
            $sellQuery->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
        }

        $deliveryReport = $sellQuery->get();

        Cache::put('from', $from);
        Cache::put('to', $to);

        return view('admin.report_invoice.delivery_report', compact('deliveryReport', 'from', 'to'));
    }
    

    

}
