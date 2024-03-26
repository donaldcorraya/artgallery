@extends('customer.layout')
@section('title', 'Order | Art Gallery')
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
      <h1>{{ __('messages.Orders') }}</h1>
      
    </div>

    <section class="section">
    <form action="" method="GET">
      <div class="row">
        <div class="col-lg-4 pb-4">
          <b>{{ __('messages.Statustype') }}:</b> <select name="status_type" class="form-select">
            <option value="1" <?= ($status_type == 1) ? 'selected' : '' ?>>{{ __('messages.OrderStatus') }}</option>
          </select>
        </div>
        <div class="col-lg-4 pb-4">
          <b>{{ __('messages.CheckbyStatus') }}:</b> <select name="delivery_status" class="form-select">
            <option value="0" <?= ($delivery_status == 0) ? 'selected' : '' ?>>{{ __('messages.Pending') }}</option>
            <option value="1" <?= ($delivery_status == 1) ? 'selected' : '' ?>>{{ __('messages.Accepted') }}</option>
            <option value="2" <?= ($delivery_status == 2) ? 'selected' : '' ?>>{{ __('messages.Delivered') }}</option>
            <option value="3" <?= ($delivery_status == 4) ? 'selected' : '' ?>>{{ __('messages.Canceled') }}</option>
          </select>
        </div>

        <div class="col-lg-4 pt-4">
          <button type="submit" class="btn btn-outline-success">{{ __('messages.Search') }}</button>
        </div>
      </div>
    </form>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- <h5 class="card-title">Datatables</h5> -->

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>{{ __('messages.OrderId') }}</th>
                    <th>{{ __('messages.OrderDate') }}</th>
                    <th>{{ __('messages.Amount') }}</th>
                    <th>{{ __('messages.Status') }}</th>
                    <th>{{ __('messages.Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                
                    @foreach($arr as $itm)
                        <tr>
                            <td>{{ $itm['id'] }}</td>
                            <td>{{ $itm['order_date'] }}</td>
                            <td>{{ $itm['order_total'] }}</td>
                            <td>
                                @if($itm['order_status'] == '0') <span class="badge bg-secondary">{{ __('messages.Pending') }}</span> @endif
                                @if($itm['order_status'] == '1') <span class="badge bg-primary">{{ __('messages.Accepted') }}</span> @endif
                                @if($itm['order_status'] == '2') <span class="badge bg-success">{{ __('messages.Delivered') }}</span> @endif
                                @if($itm['order_status'] == '3') <span class="badge bg-info">{{ __('messages.Confirmded') }}</span> @endif
                                @if($itm['order_status'] == '4') <span class="badge bg-danger">{{ __('messages.Canceled') }}</span> @endif
                            </td>                            
                            <td>
                                <a href="{{ route('front.orderDetails', $itm['id'] )}}"><button class="btn btn-primary">{{ __('messages.Details') }}</button></a>
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