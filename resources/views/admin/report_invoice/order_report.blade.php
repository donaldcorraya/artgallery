@extends('admin.layout')
@section('title', 'Order Report | Art Gallery')
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
    </div>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <form action="{{ route('order.invioce') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col pb-3">
                                <label for="fromDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" value="{{ $from }}" id="fromDate"
                                    name="fromdate">
                            </div>
                            <div class="col pb-3">
                                <label for="toDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" value="{{ $to }}" id="toDate" name="todate">
                            </div>
                            <div class="col pb-3">
                                <label for="toDate" class="form-label">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Accepted</option>
                                    <option value="2">Delivered</option>
                                    <option value="3">Confirmded</option>
                                    <option value="4">Canceled</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-1 pb-3">
                            <button type="submit" class="btn btn-primary fw-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(!empty($orderReport))
            <div class="col-md-12">
                <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <table class="table table-bordered" id="sell">
                        <thead>
                            <tr>
                                <td>Sl.No</td>
                                <td>Transaction ID </td>
                                <td>Phone </td>
                                <td>Email </td>
                                <td>Total </td>
                                <td class="text-center">Action </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sum = 0;
                            @endphp
                            @foreach($orderReport as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->transaction_id }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->order_total }}</td>
                                <span class="d-none">{{ $sum += $item->order_total}}</span>
                                <td class="text-end">
                                    <a href="{{ route('order_details.invoice', $item->id) }}" class="btn btn-info">Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total </td>
                                <td>{{$sum}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="text-right mt-2">
                        <button class="btn btn-primary" onclick="printTable()">Print</button>
                        <a href="{{ route('export-order-report') }}" class="btn btn-info">Export to PDF</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

</main>
@endsection
@push('script')
<script>
function printTable() {
    // Specify the table element or its ID
    printJS({
        printable: 'sell', // ID or HTML element
        type: 'html',
        style: `
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
                th {
                    background-color: #f2f2f2;
                }
            `
    });
}
</script>
@endpush