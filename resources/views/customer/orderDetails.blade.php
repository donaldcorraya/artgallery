@extends('customer.layout')
@section('title', 'Order Details | Art Gallery')
@section('content')

<?php

use App\Models\ProductModel;

?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ __('messages.OrderDetails') }}</h1>

    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-item-center">
                                    <h5 class="card-title">{{ __('messages.History') }}</h5>
                                    <a class="mt-2" href="{{url('/customer_dashboard')}}"><button class="btn btn-sm btn-success">{{ __('messages.Dashboard') }}</button></a>
                                </div>

                                <!-- Table with stripped rows -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('messages.Name') }}</th>
                                            <th scope="col">{{ __('messages.Price') }}</th>
                                            <th scope="col">{{ __('messages.QTY') }}</th>
                                            <th scope="col">{{ __('messages.Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach(json_decode($product->product_arr) as $p){                                                        
                                            $data = ProductModel::find($p->product_id);                                                    
                                        ?>
                                        <tr>
                                            <td>

                                                <img src="{{ asset($data['image']) }}"
                                                    style="width: 100px; height: auto;">

                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->selling_price }}</td>
                                            <td>{{ $p->product_qty }}</td>
                                            <td>{{ $p->product_qty*$data->selling_price }}</td>

                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="5" class="text-end pe-5">
                                                <b>{{ __('messages.Tax') }} : + {{ $product->tax_total }}</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" class="text-end pe-5">
                                                <b>{{ __('messages.TotalAmount') }}: {{ $product->order_total }}</b>
                                            </td>
                                        </tr>
                
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>
                        <!-- Bordered Tabs -->
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{ __('messages.Name') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.Phone') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->phone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.Email') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.TotalAmount') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->order_total }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.OrderDate') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ diffForHumans($product->order_date) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.Status') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->order_status }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.Address') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->delivery_address }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.DeliveryStatus') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->delivery_status }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.PaymentMethod') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->payment_method }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.paymentamount') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->payment_amount }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.PaymentDate') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ diffForHumans($product->payment_date) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.PaymentStatus') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->payment_status }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.Currency') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->currency }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __('messages.TransactionId') }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $product->transaction_id }}</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    </section>

</main>

@endsection