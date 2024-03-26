@extends('admin.layout')
@section('title', 'Order Report invoice | Art Gallery')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Order Report</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('order.report')}}">Order Report</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end pt-2">
                <a href="{{ route('order.report') }}" class="btn btn-sm btn-dark"><i class="fa-solid fa-magnifying-glass"></i>
                    Search</a>
                <a href="#" class="btn btn-sm btn-danger" id="printBtn" onclick="printInvoice()"><i class="fa-solid fa-file-invoice"></i> 
                    Print</a>
            </div>
        </div>
        <hr>
        <div class="invioce shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <div class="px-5">
                <div class="pt-3" id="invice">
                    <div class="d-flex justify-content-between">
                        <div class="text">
                            <p class="mb-0">Invoice NO: {{$orderReport->id}}</p>
                            <p class="mb-0">Issue Date: {{ date('d M Y', $orderReport->created_at->timestamp) }}</p>
                        </div>
                        <div class="w-100 text-end">
                            @if(isset(gs()->logo))
                            <img class="text-end" style="width: 200px;" src="{{ asset('assets/images/setting/'.gs()->logo) }}" alt="Logo">
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6><strong>Customer's Information</strong></h6>
                            <p class="mb-0">{{$orderReport->firstName .' '. $orderReport->lastName}}</p>
                            <p class="mb-0">{{$orderReport->email}}</p>
                            <p class="mb-0">{{$orderReport->phone}}</p>
                            <p class="mb-0">{{$orderReport->street_address .','. $orderReport->city .','. $orderReport->state}}</p>
                        </div>
                        <div class="col-sm-6 text-end">
                            @foreach ($companyinfo as $item)
                                <h6><strong>Company Information</strong></h6>
                                <p class="mb-0">{{$item->business_name}}</p>
                                <p class="mb-0">{{$item->business_email}}</p>
                                <p class="mb-0">{{$item->business_number}}</p>
                                <p class="mb-0">{{$item->business_address}}</p>
                            @endforeach
                            
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <h6><strong>Hirer’s Info</strong></h6>
                        <div class="col-sm-3">
                            <div class="">
                                <p class="mb-0"><strong>Shhipping Date</strong></p>
                                <p class="mb-0">{{ date('Y-m-d', $orderReport->delivery_date) }}</p>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="d-flex">
                                <p class="mb-0 col-3"><strong>Shipping </strong></p>
                                <p class="mb-0">
                                    {{$shipping['street_address']}}, {{$shipping['city']}}, {{$shipping['state']}}, {{$shipping['postal']}}, {{$shipping['country']}}
                                </p>
                            </div>
                            <div class="d-flex">
                                <p class="mb-0 col-3"><strong>Billing </strong></p>
                                <p class="mb-0">
                                    {{$billing['street_address']}}, {{$billing['city']}}, {{$billing['state']}}, {{$billing['postal']}}, {{$billing['country']}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table_responsive">
                                <table class="border table" style="width: 100%; ">
                                    <thead>
                                        <tr>
                                            <th>Items Details</th>
                                            <th>Price</th>
                                            <th>QTY</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $grandTotal= 0;
                                            $tax= $orderReport->tax_total; 
                                        @endphp 

                                        @foreach ($productArr as $item)
                                        @php
                                            $price          = $item['product_price'];
                                            $qty            = $item['product_qty'];
                                            $productPrice   = $price * $qty;
                                            $grandTotal    += $productPrice;
                                        @endphp 
                                        
                                        <tr>
                                            <td>{{ $item['product_name'] }}</td>
                                            <td>{{ $item['product_price'] }}</td>
                                            <td>{{ $item['product_qty'] }}</td>
                                            <td>{{ $productPrice }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Tax</td>
                                            <td>+{{$tax}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th>Total Amount</th>
                                            <th>${{$grandTotal+$tax}}</th>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table_responsive">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{-- <b>Pay By</b><br> Credit Card - 236***************** <br>Jone Due --}}
                                                <b>Payment</b><br> Cash in Delivery
                                            </td>
                                            <td></td>
                                            <td>
                                                <p></p>
                                            </td>
                                            <td>Total Amount:</td>
                                            <td><strong>${{$grandTotal+$tax}}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <div class="tm_bottom_invoice_left">
                            <p style="color: #B9B4C7; font-size: 18px;">Thank you for your business.</p>
                            <p style="color: #111; font-size: 12px; font-weight: 700;">Terms & Condition</p>
                            <p style="color: #666; font-size: 12px; margin-top: -10px;">IInvoice was created on a computer
                                and is valid without the signature and seal.</p>
                        </div>
                        <div class="w-100 text-end">
                            @if(isset(gs()->logo))
                            <img class="text-end pt-5" style="width: 200px;" src="{{ asset('assets/images/setting/'.gs()->logo) }}" alt="Logo">
                            @endif
                        </div>
                    </div>
                    
                    
                </div>
                <button class="btn btn-primary" onclick="printInvoice()">Print</button>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.3/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        function printInvoice() {
            var printContent = document.getElementById('invice').innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endsection
