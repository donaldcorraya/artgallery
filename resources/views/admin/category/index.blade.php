@extends('admin.layout')
@section('title', 'Category list | Art Gallery')
@section('content')

<style>
    .img_image {
        width: 120px;
        height: auto;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">

        @if(Session::has('flash_message'))
        <br><br>
        <div id="flash-message" class="alert alert-success">
            <h5>{{ Session::get('flash_message') }}</h5>
        </div>
        @endif
        
        @if(Session::has('del_message'))
        <br><br>
        <div id="del-message" class="alert alert-danger">
            <h5>{{ Session::get('del_message') }}</h5>
        </div>
        @endif


        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/category')}}">Category</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="pb-3 pt-3">
                                <h5 class="card-title float-start">All</h5>
                                <a href="{{route('category.create')}}"><button class="btn btn-dark float-end"><i class="bi bi-plus"></i> Add New</button></a>
                            </div>

                            <div class="col-lg-12">
                                <!-- Default Table -->
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" class="px-5">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($arr as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td><img class="img_image" src="{{ asset($item->image) }}"></td>
                                                <td>{{ $item->status == 1 ? 'Active' :'Inactive'}}
                                                <td d-flex>
                                                    <a class="pe-1" href="{{ url('/category/'. $item->id)}}"><button class="btn btn-sm btn-primary">Edit</button></a>
                                                    <form method="POST" action="{{ url('/category' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut('slow');
        $('#del-message').fadeOut('slow');
    }, 000);
</script>
@endsection