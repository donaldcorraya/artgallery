@extends('admin.layout')
@section('title', 'Page List')
@section('content')
<section class="section main" id="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card top-selling overflow-auto">

                        <div class="card-body pb-0">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h5 class="card-title">Page List</h5>
                                <div class="filter" style="padding-right: 25px;">
                                    <a href="{{ route('pages.create') }}" class="btn-sm btn btn-info"><i class="bi bi-file-plus-fill"></i> Add New Page</a>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Slug </th>
                                        <th>Created </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index +1 }}</th>
                                        <td>{{ $item->title  }}</td>
                                        <td>{{ $item->slug }}</td>

                                        <td>{{ dateFormat($item->created_at) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('pages.edit', $item->id) }}" type="button" class="btn me-2 btn-secondary"><i class="bi bi-pencil"></i></a>
                                                <a href="{{ route('pages.destroy', $item->id) }}" type="button" class="btn btn-danger" onclick="return confirm('Are you sure dalete')"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div><!-- End Top Selling -->
            </div>
        </div>
    </div>
</section>
@endsection