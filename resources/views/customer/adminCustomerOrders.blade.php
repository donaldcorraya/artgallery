@extends('admin.layout')
@section('title', 'Order | Arth Gallery')
@section('content')

<?php

  if (isset($_GET['status_type'])) {
    $status_type = $_GET['status_type'];
  } else {
    $status_type = '';
  }

  if (isset($_GET['delivery_status'])) {
    $delivery_status = $_GET['delivery_status'];
  } else {
    $delivery_status = '';
  }

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Customer's Order</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Customer's Order</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    @if(isset($filter) && $filter == 1)
    <form action="" method="GET">
      <div class="row">
          <div class="col-lg-4 pb-4">
            <b>Status type:</b>
              <select name="status_type" class="form-select">
                  <option value="1" <?= ($status_type == 1) ? 'selected' : '' ?>>Order Status</option>
                  <!-- <option value="2" <//?= ($status_type == 2) ? 'selected' : '' ?>>Payment Status</option> -->
              </select>
          </div>
          <div class="col-lg-4 pb-4">
            <b>Check by Status:</b>
            <select name="delivery_status" class="form-select">
              <option value="0" <?= ($delivery_status == 0) ? 'selected' : '' ?>>Pending</option>
              <option value="1" <?= ($delivery_status == 1) ? 'selected' : '' ?>>Accepted</option>
              <option value="2" <?= ($delivery_status == 2) ? 'selected' : '' ?>>Delivered</option>
              <option value="3" <?= ($delivery_status == 3) ? 'selected' : '' ?>>Confirmded</option>
              <option value="4" <?= ($delivery_status == 4) ? 'selected' : '' ?>>Cancel</option>
            </select>
          </div>

        <div class="col-lg-4 pt-4">
          <button type="submit" class="btn btn-outline-success">Search</button>
        </div>
      </div>
    </form>
    @endif
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body table-responsive">

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Total Cost</th>
                  <th>Order Date</th>
                  <th>Status</th>
                  {{-- <th>Delivery Address</th>
                  <th>Delivery Status</th>
                  <th>Payment Method</th>
                  <th>Payment Amount</th>
                  <th>Payment Date</th>
                  <th>Payment Status</th>
                  <th>Currency</th> --}}
                  <th>Transaction ID</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($arr as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->order_total }}</td>
                  <td>{{ $item->order_date }}</td>
                  <td>
                    @if($item->order_status == '0') <span class="badge bg-secondary">Pending</span> @endif
                    @if($item->order_status == '1') <span class="badge bg-primary">Accepted</span> @endif
                    @if($item->order_status == '2') <span class="badge bg-success">Delivered</span> @endif
                    @if($item->order_status == '3') <span class="badge bg-info">Confirmded</span> @endif
                    @if($item->order_status == '4') <span class="badge bg-danger">Cancel</span> @endif

                  </td>
                  {{-- <td>{{ $item->delivery_address }}</td>
                  <td>{{ $item->payment_method }}</td>
                  <td>{{ $item->payment_amount }}</td>
                  <td>{{ $item->payment_date }}</td>
                  <td>{{ $item->payment_status }}</td>
                  <td>{{ $item->currency }}</td> --}}
                  <td>{{ $item->transaction_id }}</td>
                  <td>
                    <a href="{{ route('front.adminOrderDetails', $item->id) }}" class="link-secondary">
                      <button class="btn btn-sm btn-primary">Details</button>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('orders.delete', $item->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main>
@endsection