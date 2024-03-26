@extends('frontend.layout')
@section('title', 'Cart | Arth Gallery')
@section('content')

<!--===========================cart_page part start===================================-->

<section class="cart_page">
  <div class="container">
    <div class="row">
      <div class="card">
        <div class="row">
          <div class="col-md-8 cart">

            @if(Session::has('success'))
            <div class="alert_message alert alert-success" role="alert"><b>{{ Session::get('success') }}</b></div>
            @endif

            @if(Session::has('error'))
            <div class="alert_message alert alert-danger" role="alert"><b>{{ Session::get('error') }}</b></div>
            @endif

            <div class="title">
              <div class="row">
                <div class="col">
                  <h4><b>{{ __('messages.ShoppingCart') }}</b></h4>
                </div>
                <div class="col align-self-center text-right text-muted">{{ Cart::count() }} {{ (Cart::count() > 1)? 'items' : 'item' }}</div>
              </div>
            </div>

            @if(Cart::count()> 0)
              
              @foreach($cartContent as $item)
              
              <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                  <div class="col-2">
                    <img class="img-fluid" src="{{ asset($item->options->productImage)}}">
                  </div>
                  <div class="col">
                    <div class="row text-muted">{{ $item->name }}</div>
                  </div>
                  <div class="col qty">
                    <a href="javascript:void(0)" class="sub" data-id="{{ $item->rowId }}">-</a>
                    <a href="javascript:void(0)" class="border product_qty">{{ $item->qty }}</a>                    
                    <a  href="javascript:void(0)" class="add" data-id="{{ $item->rowId }}">+</a>
                  </div>
                  <div class="col d-flex"><span>&dollar; {{ $item->price}}</span> <button style="margin-right: 0; display: contents;" onclick="deleteItem('{{ $item->rowId }}')"><span class="close">&#10005;</span></button></div>
                </div>
              </div>
              @endforeach
            @else
              <div class="row border-top border-bottom">
                  <div class="row main align-items-center">
                    <div class="col-12 text-center">
                      <b>{{ __('messages.Cartisempty') }}</b>
                    </div>                    
                </div>
              </div>                 
            @endif


            
            
            <div class="back-to-shop"><a href="/">&leftarrow;</a><span class="text-muted">{{ __('messages.Backtoshop') }}</span></div>
          </div>
          <div class="col-md-4 summary">
            <div>
              <h5><b>{{ __('messages.Summary') }}</b></h5>
            </div>
            <hr>
            <div class="row">
              <div class="col" style="padding-left:0;">{{ (Cart::count() > 1)? 'ITEMS' : 'ITEM' }} {{ Cart::count() }}</div>
              <div class="col text-right">&dollar; {{ Cart::subtotal() }}</div>
            </div>
            
            <div class="row">
              <div class="col" style="padding-left:0;">{{ __('messages.Tax') }} : </div>
              <div class="col text-right">&dollar; {{ Cart::tax() }}</div>
            </div>
            
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
              <div class="col">TOTAL PRICE</div>
              <div class="col text-right">&dollar; {{ Cart::total() }}</div>
            </div>
            <a href="{{ route('front.checkout') }}"><button class="btn">{{ __('messages.CHECKOUT') }}</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--===========================cart_page part end===================================-->

@include('frontend.bottomLogos')

@endsection

@push('script')
<script>

    $('.add').on('click',function(){
        var qtyElement = $(this).closest('.qty').find('.product_qty').text();
        var qtyValue = parseInt(qtyElement);

        if(qtyValue <10){
          var rowId = $(this).data('id');   
          var newQty = qtyValue+1
          $(this).closest('.qty').find('.product_qty').text(newQty);
          updateCart(rowId, newQty);
        }
    });

    $('.sub').on('click',function(){
        var qtyElement = $(this).closest('.qty').find('.product_qty').text();
        var qtyValue = parseInt(qtyElement);

        if(qtyValue > 1){
          var rowId = $(this).data('id');   
          var newQty = qtyValue-1
          $(this).closest('.qty').find('.product_qty').text(newQty);
          updateCart(rowId, newQty);
        }
    });

    function updateCart(rowId, qty){
        //console.log(rowId, qty);

        $.ajax({

          url : "{{ route('front.updateCart') }}",
          type : 'post',
          data : {
            "_token": "{{ csrf_token() }}",
            'rowId' : rowId,
            'qty'   : qty
          },
          dataType : 'json',
          success : function(res){            
              window.location.href= "{{ route('front.cart') }}";            
          }

        });
    }

    function deleteItem(rowId){
      if(confirm("Are you sure want to delete?")){
          $.ajax({
              url : "{{ route('front.deleteItem') }}",
              type : 'post',
              data : {
                "_token": "{{ csrf_token() }}",
                'rowId' : rowId,
              },
              dataType : 'json',
              success : function(res){            
                  window.location.href= "{{ route('front.cart') }}";            
              }
          });
      }
    }
    $('.alert_message').delay(2000).fadeOut('slow');

</script>

@endpush