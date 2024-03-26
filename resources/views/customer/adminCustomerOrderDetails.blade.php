@extends('admin.layout')
@section('title', 'Order Details | Art Gallery')
@section('content')


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


<?php

use App\Models\ProductModel;

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Order Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-success" style="display: none;">
        <strong>Updated</strong> successfully.
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product Summary</h5>

                        <table class="table table-borderless">
                            @foreach( json_decode($arr->product_arr) as $itm)
                            <tr>
                                <td>
                                    <?php $data = ProductModel::find($itm->product_id);?>
                                    <img src="{{ asset($data['image']) }}" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $itm->product_name }}</td>
                                <td>{{ $itm->product_price }}</td>
                                <td>{{ $itm->product_qty }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">
                                    <b>Total: ${{ $arr->order_total }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product Status</h5>

                        <table class="table table-borderless">

                            <tr>
                                <th>Status</th>
                                <td>
                                    <select id="product_status" class="form-select">
                                        
                                        @foreach($status as $k =>$status_itm)
                                            <option value="{{ $k }}" <?= ($status_id == $k)? 'selected' :''?> >{{ $status_itm }}</option>
                                        @endforeach
                                        
                                    </select>                                    
                                </td>
                            </tr>

                            <tr>
                                <th>Delivery Date</th>
                                <td><input type="text" id="date" <?=(!$delivery_status)? 'disabled' : ''?> value="<?=(isset($delivery_date)? date('d-m-Y', $delivery_date): '')?>" class="form-control"></td>
                                <td><button id="date_btn" class="btn btn-primary">Save</button></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Summary</h4>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="pb-3">
                                        <b>Name : </b>
                                        <small>{{ $arr->name }}</small>
                                </div>

                                <div class="pb-3">
                                    <b>Payment Information : </b>
                                    <small>{{ $arr->payment_method }}</small>
                                </div>

                                <div class="pb-3">
                                    <b>Order Totals : </b>
                                    <small>Subtotal $ {{ $arr->order_total }} Shipping & Handing $ {{ $arr->shipping_total }}</small>
                                </div>

                                
                            </div>
                            <div class="col-lg-4">

                                <div class="pb-3">
                                    <b>Billing Address : </b>
                                    <small>
                                        <?php 
                                            
                                            foreach(json_decode($arr->billing) as $b){
                                                echo $b.", ";
                                            }
                                        ?>
                                    </small>
                                </div>

                                <div class="pb-3">
                                    <b>Shipping Address : </b>
                                    <small>
                                        <?php 
                                            
                                            foreach(json_decode($arr->shipping) as $s){
                                                echo $s.", ";
                                            }
                                        ?>
                                    </small>
                                </div>
                                
                            </div>
                            <div class="col-lg-4">
                                

                                <div class="pb-3">
                                    <b>Phone : </b>
                                    <small>{{ $arr->phone }}</small>
                                </div>

                                <div class="pb-3">
                                    <b>E-mail : </b>
                                    <small>{{ $arr->email }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="date_alert" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delivery Date not Set</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function () {
      @if(session('success'))
          toastr.success('{{ session('success') }}');
      @endif
  });
</script>

<script>
    $('#product_status').on('change', function() {
        var status = $('#product_status').val();

        status_update(status);

        
    });


    function status_update(status){
        $.ajax({
                type: 'POST',
                url: "{{ route('product_status_update') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'order_status': status,
                    'id': "{{ $order_id }}",
                    'data': '1'
                },
                dataType: 'json',
                success: function(data) {
                    
                    if (data) {

                        if(data.error){
                            $('.modal-body').text(data.error);   
                            $('#date_alert').modal('toggle');   
                        }else{
                            $('.spinner-border').hide();
                            toastr.success('Order status updated successfully');
                            //window.location.reload();
                        }                        
                    }
                },
                error: function(req, status, error) {
                    var err = req.responseJSON.value;
                    console.log(err);
                }

            });
    }

    
</script>
<script>
    $(document).ready(function(){
        $('#date_btn').on('click', function(){

        if(!$('#date').prop('disabled')){
            var delivery_date = $("#date").val();
            $.ajax({
                type: 'POST',
                url: "{{ route('delivery-date-update') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'delivery_date': delivery_date,
                    'id': "{{ $order_id }}",
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.error);
                    if (data.error) {
                        toastr.error(data.error);
                    }else{
                        toastr.success('Date updated'); 
                        //window.location.reload();
                    }
                },
                error: function(req, status, error) {
                    var err = req.responseJSON.value;
                    console.log(err);
                }

            });
        }            
            
    });

        $('#delivery_status').on('change', function() {
            var status = $('#delivery_status').val();

            $('.spinner-border').show();
            $.ajax({
                type: 'POST',
                url: '/product_status_update',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'delivery_status': status,
                    'id': "{{ $arr->id }}",
                    'data': '2'
                },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('.spinner-border').hide();                        
                        toastr.success('Delivery status updated successfully');
                        window.location.reload();
                    }
                }
            });
        });
    });


    $("#date").datepicker({
        format: 'Y-m-d H:i:s',
    });
</script>
@endsection