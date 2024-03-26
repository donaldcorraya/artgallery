@extends('admin.layout')
@section('title', 'Wishlist Report | Art Gallery')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">

                <h1>Wishlist Report</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('wishlist.report')}}">Wishlist Report</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
        </div>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <form action="{{ route('customer.wishlist.report') }}" method="post">
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
                        </div>
                        <div class="row g-1 pb-3">
                            <button type="submit" class="btn btn-primary fw-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(!empty($wishlistReport))
            <div class="col-md-12">
                <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <table class="table table-bordered" id="sell">
                        <thead>
                            <tr>
                                <td>Sl.No</td>
                                <td>Name</td>
                                <td>Email </td>
                                <td>Product </td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sum = 0;
                            @endphp
                            @foreach($wishlistReport as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name ?? '' }}</td>
                                <td>{{ $item->user->email ?? '' }}</td>
                                <td>{{ $item->product->name ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right mt-2">
                        <button class="btn btn-primary" onclick="printTable()">Print</button>
                        <a href="{{ route('export-wishlist-report') }}" class="btn btn-info">Export to PDF</a>
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