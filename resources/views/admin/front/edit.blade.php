@extends('admin.layout')
@section('title', 'Page Update')
@section('content')


<section class="section main" id="main">
    <form action="{{ route('pages.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Page Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}">
                            </div>
                        </div>
                        
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Page Slug <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ $item->slug }}">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Content </label>
                            <div class="col-sm-10">
                                <textarea class="form-control editor" id='editor' name="content">{!! $item->content !!}</textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-5 mt-5">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <a class="btn btn-danger" style="margin-right: 10px" href="{{ route('pages.index') }}">Cancel </a>
                                    <button class="btn btn-info" type="submit">Save  </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</section>h
</script>

@endsection

@push('custom-script')
<script>
    $(function(){
        $(document).ready(function () {
            // Select the title input field
            var $title = $('#title');

            // Select the slug input field
            var $slug = $('#slug');

            // Add a change event listener to the title field
            $title.on('input', function () {
                // Get the value of the title field
                var titleValue = $title.val();

                // Convert the title to a slug
                var slugValue = titleValue.toLowerCase().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-');

                // Update the value of the slug field
                $slug.val(slugValue);
            });
        });
    });

    @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
    @endforeach
</script>

@endpush

@push('script')
<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

    @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
    @endforeach
</script>
@endpush