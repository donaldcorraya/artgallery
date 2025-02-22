@extends('admin.layout')
@section('title', 'Blog list | Art Gallery')
@section('content')

<style>
    .banner_img {
        width: 100px;
        height: auto;
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

        <h1>Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/blog')}}">Blog</a></li>
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
                                <a href="{{route('blog.create')}}"><button class="btn btn-dark float-end"><i class="bi bi-plus"></i> Add New</button></a>
                            </div>

                            <div class="col-lg-12">
                                <!-- Default Table -->
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">slug</th>
                                                <th scope="col">banner</th>
                                                <th scope="col">meta_title</th>
                                                <th scope="col">meta_image</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" class="px-5">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($arr as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td><img class="banner_img" src="{{ $item->banner }}"></td>
                                                <td>{{ $item->meta_title }}</td>
                                                <td><img class="banner_img" src="{{ $item->meta_image }}"></td>
                                                <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ url('/blog/'. $item->id)}}" class="pe-1"><button class="btn btn-sm btn-success">View</button></a>
                                                    <form method="POST" action="{{ url('/blog' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                        </div>
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection