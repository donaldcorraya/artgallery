<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class PdfController extends Controller
{
    public function saleReport(){
        $from = Cache::get('from');
        $to = Cache::get('to');
        
        $sellQuery = OrderModel::query()
            ->with(['customer' => function ($query) use ($from, $to) {
                if ($from && $to) {
                    $query->whereDate('created_at', '>=', $from)
                          ->whereDate('created_at', '<=', $to);
                }
            }]);
        $salesReport = $sellQuery->where('order_status', 1)->get();
        $pdf = PDF::loadView('pdf.sale_report', compact('salesReport'));
        return $pdf->download('sell.pdf');
    }
    
    public function orderReport(){
        $from = Cache::get('from');
        $to = Cache::get('to');
        $status = Cache::get('status');
        
        $sellQuery = OrderModel::query()
        ->with(['customer' => function ($query) use ($from, $to) {
            if ($from && $to) {
                $query->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }]);

        if($status){
            $sellQuery->where('order_status', $status);
        }
        $orderReport = $sellQuery->get();

        $pdf = PDF::loadView('pdf.order', compact('orderReport'));
        return $pdf->download('order.pdf');
    }
    
    public function delivery(){
        $from = Cache::get('from');
        $to = Cache::get('to');
        $status = Cache::get('status');
        
        $sellQuery = OrderModel::query()
        ->with(['customer' => function ($query) use ($from, $to) {
            if ($from && $to) {
                $query->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }]);

        if($status){
            $sellQuery->where('order_status', $status);
        }
        $orderReport = $sellQuery->get();

        $pdf = PDF::loadView('pdf.order', compact('orderReport'));
        return $pdf->download('order.pdf');
    }

    public function wishlist(){
        $from = Cache::get('from');
        $to = Cache::get('to');
        $status = Cache::get('status');
        $sellQuery = Wishlist::query();
        
        if ($from && $to) {
            $sellQuery->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
        }

        $wishlistReport = $sellQuery->with(['user', 'product'])->get();
        $pdf = PDF::loadView('pdf.wishlist', compact('wishlistReport'));
        return $pdf->download('wishlist.pdf');
    }
}
