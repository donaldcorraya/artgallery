@extends('admin.layout')
@section('title', 'Menu List')
@section('content')
<section class="section main" id="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card top-selling overflow-auto">
                        <div class="card-body pb-0">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h5 class="card-title" style="margin-right: 10px;">Menu List</h5>
                            <a href="{{ route('menus.create') }}" class="btn-sm btn btn-info"><i class="bi bi-file-plus-fill"></i> Add New Menu</a>
                        </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Created At </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index +1 }}</th>
                                        <td>{{ $item->name  }}</td>
                                        <td>{{ $item->url }}</td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge bg-success">Active</span> 
                                            @else 
                                            <span class="badge bg-danger">Inactive</span> 
                                            @endif 
                                        </td>
                                        <td>{{ dateFormat($item->created_at) }}</td>
                                        <td>
                                        <div class="d-flex">
                                            <a href="{{ route('menus.edit', $item->id) }}" type="button" class="btn me-2 btn-secondary"><i class="bi bi-pencil"></i></a>
                                            <a href="{{ route('menus.destroy', $item->id) }}" type="button" class="btn btn-danger" onclick="return confirm('Are you sure dalete')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
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

