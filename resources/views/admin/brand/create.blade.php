@extends('admin.layout')
@section('title', 'Brand | Art Gallery')
@section('content')


<main id="main" class="main">
    <div class="d-flex justify-content-between">
        <div class="pagetitle">
            <h1>Brand</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('brand.index')}}">Brand</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>
        <div class="text-end pt-2">
            <a href="{{ route('brand.index') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i> View
                Data</a>
        </div>
    </div>
    <hr>
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data" class="row g-3 p-3">
            @csrf
    
            <div class="col-md-12 pb-3">
                <label for="brand_tagline" class="form-label">Tagline<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="brand_tagline" name="brand_tagline" value="{{old('brand_tagline')}}" required>
                @error('brand_tagline')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-4">
                <label for="" class="form-label">Image<span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="brand_img" name="brand_img" value="{{old('brand_img')}}" required>
                @error('brand_img')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    
</main>
@endsection

