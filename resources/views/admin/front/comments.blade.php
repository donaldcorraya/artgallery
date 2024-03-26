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
                                <h5 class="card-title">Comment List</h5>                                
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Post Title</th>
                                        <th>User </th>
                                        <th>Comments </th>
                                        <th>Created </th>
                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index +1 }}</th>
                                        <td>{{ $item->blog->title ?? ''  }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>{{ dateFormat($item->created_at) }}</td>
                                        <td>
                                            @if($item->status == 0)
                                            <span class="badge bg-info"> Pending </span>
                                            @else
                                            <span class="badge bg-success"> Approved </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('change-comment-status', $item->id) }}" id="statusForm_{{ $item->id }}" method="POST">
                                                    @csrf
                                                    <select name="status" class="form-control" onchange="submitForm({{ $item->id }})">
                                                        <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Pending</option>
                                                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Approved</option>
                                                    </select>
                                                </form>
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

@push('script')
<script>
    function submitForm(itemId) {
        var formId = "statusForm_" + itemId;
        document.getElementById(formId).submit();
    }
</script>
@endpush