@extends('admin.layout')
@section('title', 'Category Create | Art Gallery')
@section('content')


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/category')}}">Category</a></li>
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New</h5>

                        <form class="row g-3" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="col-12">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" required>
                                <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="slug" class="form-label">Slug<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('slug') }}" name="slug" class="form-control" id="slug" required>
                                <b><small class="text-danger">{{ $errors->first('slug') }}</small></b>
                            </div>
							
							<div class="col-12">
                                <label for="inputNanme4" class="form-label">Photo</label>
                                <input type="file" value="{{ old('image') }}" name="image" class="form-control" id="inputNanme4">
                                <b><small class="text-danger">{{ $errors->first('image') }}</small></b>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

<script>

    $("#name").keyup(function() {
            var txt = $("#name").val();
            txt = txt.replace(/\s+/g, '-').toLowerCase();
        $("#slug").val(txt);
    });

</script>
@endsection