@extends('admin.layout')
@section('title', 'Coupon list | Art Gallery')
@section('content')

<style>

    .del_btn{display: flex;}

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


        <h1>Coupon</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/coupon')}}">Coupon</a></li>
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
                                <a href="{{ route('coupon.create') }}"><button class="btn btn-dark float-end"><i class="bi bi-plus"></i> Add New</button></a>
                            </div>
                            <div class="col-lg-12">
                                <!-- Default Table -->
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Max Uses</th>
                                                <th scope="col">Max Uses User</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Discount Amount</th>
                                                <th scope="col">Max Amount</th>
                                                <th scope="col">Min Amount</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Starts At</th>
                                                <th scope="col">Expires At</th>
                                                <th scope="col" class="px-5">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($arr as $itm)
                                            <tr>
                                                <td scope="col">{{ $loop->iteration }}</td>
                                                <td scope="col">{{ $itm['code'] }}</td>
                                                <td scope="col">{{ $itm['name'] }}</td>
                                                <td scope="col">{{ $itm['description'] }}</td>
                                                <td scope="col">{{ $itm['max_uses'] }}</td>
                                                <td scope="col">{{ $itm['max_uses_user'] }}</td>
                                                <td scope="col">{{ $itm['type'] }}</td>
                                                <td scope="col">{{ $itm['discount_amount'] }}</td>
                                                <td scope="col">{{ $itm['max_amount'] }}</td>
                                                <td scope="col">{{ $itm['min_amount'] }}</td>
                                                <td scope="col">{{ $itm['status'] }}</td>
                                                <td scope="col">{{ date('m/d/Y', $itm['starts_at']) }}</td>
                                                <td scope="col">{{ date('m/d/Y', $itm['expires_at']) }}</td>
                                                <td scope="col" class="d-flex">
                                                <a href="{{ url('/coupon/'. $itm->id)}}" class="pe-1"><button class="btn btn-sm btn-success">View</button></a>
                                                    <form method="POST" action="{{ url('/coupon' . '/' . $itm['id']) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-sm del_btn" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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