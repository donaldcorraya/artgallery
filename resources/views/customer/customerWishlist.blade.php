@extends('customer.layout')
@section('title', 'Wishlist | Art Gallery')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ __('messages.Wishlist') }}</h1>
      
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- <h5 class="card-title">Datatables</h5> -->

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>{{ __('messages.ProductName') }}</th>
                    <th>{{ __('messages.Price') }}</th>
                    <th>{{ __('messages.Image') }}</th>
                    <th>{{ __('messages.Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($indexWishlist as $item)
                      
                  
                  <tr>
                    <th>{{$item->name}}</th>
                    <th>${{$item->selling_price}}</th>
                    <th>
                      <img src="{{ asset($item->image) }}" alt="img" style="width: 100px;">
                    </th>
                    <th class="d-flex">
                      <a class="" href="{{ route('shop.details', $item->slug)}}"><button class="btn btn-sm btn-info">{{ __('messages.View') }}</button></a>
                      <a class="" href="{{ route('wishlist.destroy', $item->id)}}"><button class="btn btn-sm btn-danger">{{ __('messages.Remove') }}</button></a>
                    </th>
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