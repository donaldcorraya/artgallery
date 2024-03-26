@extends('admin.layout')
@section('title', 'Product list | Art Gallery')
@section('content')

<style>
    .product_img {
        width: 50px;
        height: 50px;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">

        @if(Session::has('flash_message'))
            <br><br>
            <div id="flash_message" class="alert alert-success">
                <h5>{{ Session::get('flash_message') }}</h5>
            </div>
        @endif
        
        @if(Session::has('del_message'))
            <br><br>
            <div id="del_message" class="alert alert-danger">
                <h5>{{ Session::get('del_message') }}</h5>
            </div>
        @endif

        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/product')}}">Product</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="pb-3 pt-3">
                                <h5 class="card-title float-start">All</h5>
                                <a href="{{route('product.create')}}"><button class="btn btn-dark float-end"><i class="bi bi-plus"></i> Add New</button></a>
                            </div>
                            <div class="col-lg-12">

                                <!-- Default Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Regular Price</th>
                                                <th>Selling Price</th>
                                                <th>Stock</th>
                                                <th>Code</th>
                                                <th>Materials</th>
                                                <th>status</th>
                                                <th>image</th>
                                                <th class="px-5">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($arr as $item)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->regular_price }}</td>
                                                <td>{{ $item->selling_price }}</td>
                                                <td>{{ $item->stock_amount }}</td>
                                                <td>{{ $item->product_code }}</td>
                                                <td>{{ $item->product_materials }}</td>
                                                <td>{{ $item->status == 1 ? 'Active' :'Inactive'}}
                                                <td><img class="product_img" src="{{ asset($item->image) }}">
                                                <td class="d-flex">
                                                    <a class="pe-1" href="{{ url('/product/'. $item->id)}}" class=""><button class="btn btn-sm btn-success">View</button></a>
                                                    <form method="POST" action="{{ url('/product' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                                <!-- End Default Table Example -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection