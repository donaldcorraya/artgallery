@extends('customer.layout')
@section('title', 'Order | Art Gallery')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{ __('messages.Rating') }}</h1>
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
                    <th>{{ __('messages.ID') }}</th>
                    <th>{{ __('messages.Product') }}</th>
                    <th>{{ __('messages.QTY') }}</th>
                    <th>{{ __('messages.Comment') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rating as $item)
                  <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->product_id}}</td>
                    <td>{{$item->review_count}}</td>
                    <td>{{$item->comment}}</td>
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