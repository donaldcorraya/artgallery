@extends('admin.layout')
@section('title', 'Slider Banner Details | Art Gallery')
@section('content')
    <style>
        .img_image {
            width: 120px;
            height: auto;
        }

        /*Content scrollbar  start*/
        .custom-scrollbar-table {
            overflow: auto;
        }

        .custom-scrollbar-table::-webkit-scrollbar {
            width: 5px;
            /* height: 5px; */
        }

        .custom-scrollbar-table::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 5px;
        }
    </style>

    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">


                <h1>Slider Banner</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('slider_banner.index')}}">Slider Banner</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end pt-2">
                <a href="{{ route('slider_banner.create') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>
                    Add
                    Data</a>
            </div>
        </div>
        <hr>
        @if(Session::has('msg'))
            <br><br>
            <div id="success-message" class="alert alert-success">
                <h5>{{ Session::get('msg') }}</h5>
            </div>
            <script>
                // Use JavaScript to hide the message after 2 seconds
                setTimeout(function(){
                    document.getElementById('success-message').style.display = 'none';
                }, 2000);
            </script>
        @endif
        <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <div class="custom-scrollbar-table">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th><span class="">ID</span></th>
                            <th><span class="pe-5">Title</span></th>
                            <th><span class="pe-5">Tagline</span></th>
                            <th><span class="pe-5">Image</span></th>
                            <th><strong class="ps-5">Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indexData as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->slider_banner_title }}</td>
                                <td>{{ $item->slider_banner_tagline }}</td>
                                <td>
                                    <img src="/images/{{ $item->slider_banner_img }}" alt="Image not found"
                                        style="height: 40px; width: 40px;" class="rounded">
                                </td>
                                <td class="d-flex icon">
                                    <a href="{{ route('slider_banner.show', $item->id) }}" type="button" class="btn view"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('slider_banner.edit', $item->id) }}" type="button" class="btn edit"><i
                                            class="fa-solid fa-pen text-warning"></i></a>
                                    <a href="{{ route('slider_banner.destroy', $item->id) }}" type="button" class="btn delete"
                                        onclick="return confirm('Are you sure dalete')"><i
                                            class="fa-solid fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
