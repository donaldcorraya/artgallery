@extends('admin.layout')
@section('title', 'Page Create')
@section('content')

<section class="section main" id="main">
    <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Page Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Page Slug <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="slug" id="slug" class="form-control" value="{{old('title')}}"  required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Content </label>
                            <div class="col-sm-10">
                                <textarea class="form-control editor" id='editor' name="content"></textarea>
                                <b><small class="text-danger">{{ $errors->first('content') }}</small></b>
                            </div>
                        </div>
                        
                        <div class="row mb-5 mt-5">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <a class="btn btn-danger" style="margin-right: 10px" href="{{ route('pages.index') }}">Cancel </a>
                                    <button class="btn btn-info" type="submit">Save </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</section>

@endsection

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