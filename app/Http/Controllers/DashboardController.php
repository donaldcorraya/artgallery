<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\BLogModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(){

        //Recent Sales start
        $indexData['orderModel'] = OrderModel::join('customers as c', 'orders.customer_id', '=', 'c.user_id')
                                ->select('orders.*', 'c.firstName', 'c.lastName', 'orders.product_arr')
                                ->latest()
                                ->paginate(50);
        //Recent Sales End

        //salesActivity  start

        $indexData['salesActivity'] = OrderModel::latest()->paginate(10)->where('order_status', 3);
                                    $today = Carbon::now();
        //salesActivity  start

        //topSellingProducts start
        $topSellingProducts = OrderModel::where('order_status', 3)->get()
                            ->flatMap(function ($order) {
                                return json_decode($order->product_arr, true);
                            })
                            ->groupBy('product_id')
                            ->map(function ($products) {
                                return [
                                    'product_id' => $products->first()['product_id'],
                                    'product_name' => $products->first()['product_name'],
                                    'product_price' => $products->first()['product_price'],
                                    'product_qty' => $products->sum('product_qty'),
 
                                ];
                            })
                            ->sortByDesc('product_qty')
                            ->take(10);
        //topSellingProducts end

        //blogModel start
        $indexData['blogModel'] = BLogModel::latest()->paginate(10)->where('status', 1); 
        //blogModel start


        // Sales | Today   Revenue | This Month  Customers | This Year  Start

        $today = now()->format('Y-m-d');
        $thisMonth = now()->startOfMonth()->format('Y-m-d');
        $thisYear = now()->startOfYear()->format('Y-m-d');
    
        $indexData['orderModelToday'] = OrderModel::where('order_status', 3)
            ->whereDate('created_at', $today)
            ->get();
    
        $indexData['orderModelThisMonth'] = OrderModel::where('order_status', 3)
            ->whereDate('created_at', '>=', $thisMonth)
            ->get();
    
        $indexData['orderModelThisYear'] = OrderModel::where('order_status', 3)
            ->whereDate('created_at', '>=', $thisYear)
            ->get();
            
        $indexData['totalRevenueToday'] = $indexData['orderModelToday']->sum('order_total');
        $indexData['totalRevenueThisMonth'] = $indexData['orderModelThisMonth']->sum('order_total');
        $indexData['totalRevenueThisYear'] = $indexData['orderModelThisYear']->sum('order_total');
    
        $indexData['customerModelToday'] = CustomerModel::where('status', 1)
            ->whereDate('created_at', $today)
            ->get();
    
        $indexData['customerModelThisMonth'] = CustomerModel::where('status', 1)
            ->whereDate('created_at', '>=', $thisMonth)
            ->get();
    
        $indexData['customerModelThisYear'] = CustomerModel::where('status', 1)
            ->whereDate('created_at', '>=', $thisYear)
            ->get();
        // Sales | Today   Revenue | This Month  Customers | This Year  End

        // monthly sales report 
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();
        
        $monthlySales = OrderModel::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();

        $chartData = [];
        foreach ($monthlySales as $sale) {
            $createdAt = $sale->order_date ?? now();
            $formattedDate = Carbon::parse($createdAt)->format('d-m-Y');

            $chartData[] = [
                'name' => $formattedDate, 
                'y' => (int)$sale->payment_amount,
            ];
        }
        // end monthly sales report 
        

        // total oder by months 
        $SalesByMonths = OrderModel::select(DB::raw("MONTH(created_at) as month"), DB::raw("SUM(payment_amount) as total_sales"))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        $months = [];
        $salesData = [];

        foreach ($SalesByMonths as $sale) {
            $months[] = date('F', mktime(0, 0, 0, $sale->month, 1));
            $salesData[] = (int)$sale->total_sales;
        }
        // end total order by months 


        $completedOrders = OrderModel::where('order_status', 2)->count();
        $pendingOrders = OrderModel::where('order_status', 0)->count();
        $pieChartData = [
            ['name' => 'Completed', 'y' => $completedOrders],
            ['name' => 'Pending', 'y' => $pendingOrders]
        ];

        return view('dashboard',compact('indexData', 'today', 'topSellingProducts', 'chartData', 'salesData', 'months', 'pieChartData'), $indexData);
    }    

}