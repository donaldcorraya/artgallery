@extends('admin.layout')
@section('title', 'Delivery Report invoice | Art Gallery')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">

                <h1>Delivery Report</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('delivery.report')}}">Delivery Report</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end pt-2">
                <a href="{{ route('wishlist.report') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>
                    Show
                    Data</a>
                <a href="#" class="btn btn-sm btn-danger" id="printBtn" onclick="printInvoice()">
                    <i class="fa-solid fa-file-invoice" style="color: #fff;"></i> Print Invoice
                </a>  
            </div>
        </div>
        <hr>
        <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            
            @if(isset($deliveryReport) && count($deliveryReport) > 0)
            <div class="px-5">
                <div class="pt-3" id="invice">
                    <div class="d-flex justify-content-between">
                        <div class="text">
                            <p class="mb-0">Art Gallery</p>
                            <p class="mb-0">Issue Date: </b>{{$dayOnly}}</p>
                        </div>
                        <div class="text-end">
                            <img src="{{ asset('images/seoinvioce.png') }}" alt="">
                        </div>
                    </div>
                    <hr>
                    @if(isset($fromDate) && isset($toDate))
                        <div class="d-flex justify-content-around">
                            <p><strong>From:</strong> {{ $fromDate->format('Y-m-d') }}</p>
                            <p><strong>To:</strong> {{ $toDate->format('Y-m-d') }}</p>
                        </div>
                    @endif
                    <!-- Display other product information as needed -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">OrderID</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Delivery Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @php
                            // Filter out non-numeric values and then calculate the sum
                                $totalPrice= 0;
                            @endphp 
                        
                        @foreach ($deliveryReport as $item)
                            @php
                                if (is_numeric($item->order_total)) {
                                    $totalPrice += $item->order_total;
                                }
							@endphp
                            <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$item->firstName . ' '. $item->lastName}}</td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->created_at->format('Y-m-d')}}</td>
                                <td>
                                    @php
                                        $status = '';
                                        $color = '';
                                        switch ($item->order_status) {
                                            case 0:
                                                $status = 'Pending';
                                                $color = 'bg-secondary';
                                                break;
                                            case 1:
                                                $status = 'Accepted';
                                                $color = 'bg-primary';
                                                break;
                                            case 2:
                                                $status = 'Delivered';
                                                $color = 'bg-success';
                                                break;
                                            case 3:
                                                $status = 'Confirmed';
                                                $color = 'bg-info';
                                                break;
                                            case 4:
                                                $status = 'Cancelled';
                                                $color = 'bg-danger';
                                                break;
                                            default:
                                                $status = 'Unknown';
                                                $color = 'bg-light';
                                        }
                                    @endphp
                                    <span class="badge {{ $color }}">{{ $status }}</span>
                                </td>
                                <td>{{$item->order_total}}</td>
                            </tr>
                        @endforeach
                        
                        <tr>
                            <th class="text-end" colspan="6">Total:</th>
                            <th class="">{{$totalPrice}}</th>
                        </tr>
                            
                        </tbody>
                    </table>
                    <hr>
                    <div class="d-flex">
                        <div class="tm_bottom_invoice_left">
                            <p style="color: #B9B4C7; font-size: 18px;">Thank you for your business.</p>
                            <p style="color: #111; font-size: 12px; font-weight: 700;">Terms & Condition</p>
                            <p style="color: #666; font-size: 12px; margin-top: -10px;">IInvoice was created on a computer
                                and is valid without the signature and seal.</p>
                        </div>
                        <div>
                            <div><img style="width: 100%;" src="{{ asset('images/seoinvioce.png') }}"
                                    alt="Logo"></div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <p class="text-center text-danger">No sales data available for the selected date range.</p>
            @endif
            
            <script>
                function printInvoice() {
                var printContent = document.getElementById('invice').innerHTML;
                var originalContent = document.body.innerHTML;
            
                document.body.innerHTML = printContent;
            
                window.print();
            
                // Restore original content after printing is done
                document.body.innerHTML = originalContent;
            }
            </script>
        </div>

    </main>
@endsection
