@extends('admin.layout')
@section('title', 'Rating | Art Gallery')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Pending Review</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ratingAll')}}">Rating</a></li>
        <li class="breadcrumb-item active">view</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">    
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body table-responsive">

            <table class="table datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Comment</th>                 
                  <th>Status</th>                 
                  <th>Review Count</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pending_rating as $item)
                    <tr>                    
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->comment }}</td>
                        <td>
                            @if($item->status == '0') <span class="badge bg-secondary">Pending</span> @endif
                            @if($item->status == '1') <span class="badge bg-primary">Published</span> @endif
                            @if($item->status == '2') <span class="badge bg-success">Hidden</span> @endif
                        </td>
                        <td>{{ $item->review_count }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('rate.pendingDetails',$item->id) }}">
                                <button class="btn btn-sm btn-primary">Details</button>
                            </a>
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

</main><!-- End #main -->

@endsection