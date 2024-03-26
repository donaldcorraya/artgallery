@extends('admin.layout')
@section('title', 'Bottom Banner Create | Art Gallery')
@section('content')


<main id="main" class="main">
    <div class="d-flex justify-content-between">
        <div class="pagetitle">

            <h1>Bottom Banner</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('bottom_banner.index')}}">Bottom Banner</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div>
        <div class="text-end pt-2">
            <a href="{{ route('bottom_banner.index') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i> View
                Data</a>
        </div>
    </div>
    <hr>
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <form method="post" action="{{ route('bottom_banner.store') }}" enctype="multipart/form-data" class="row g-3 p-3">
            @csrf
    
            <div class="col-md-6 pb-3">
                <label for="bottom_banner_title" class="form-label">Banner Title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bottom_banner_title" name="bottom_banner_title" value="{{old('bottom_banner_title')}}" required>
                @error('bottom_banner_title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-6 pb-3">
                <label for="bottom_banner_tagline" class="form-label">Tagline<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bottom_banner_tagline" name="bottom_banner_tagline" value="{{old('bottom_banner_tagline')}}" required>
                @error('bottom_banner_tagline')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-4">
                <label for="" class="form-label">Image<span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="bottom_banner_img" name="bottom_banner_img" value="{{old('bottom_banner_img')}}" required>
                @error('bottom_banner_img')
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

