@extends('admin.layout')
@section('title', 'Main Banner Edit | Art Gallery')
@section('content')


<main id="main" class="main">
    <div class="d-flex justify-content-between">
        <div class="pagetitle">

            <h1>Main Banner</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('main_banner.index')}}">Main Banner</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>
        <div class="text-end pt-2">
            <a href="{{ route('main_banner.index') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i> View
                Data</a>
        </div>
    </div>
    <hr>
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <form method="post" action="{{ route('main_banner.update', $indexData->id) }}" enctype="multipart/form-data" class="row g-3 p-3">
            @csrf
            @method('PUT')
    
            <div class="col-md-6 pb-3">
                <label for="main_banner_title" class="form-label">Banner Title<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_banner_title" name="main_banner_title" value="{{$indexData->main_banner_title}}" required>
                @error('main_banner_title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-6 pb-3">
                <label for="main_banner_tagline" class="form-label">Tagline<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_banner_tagline" name="main_banner_tagline" value="{{$indexData->main_banner_tagline}}" required>
                @error('main_banner_tagline')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="d-flex">
                <div class="col-md-4">
                    <label for="" class="form-label">Image<span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="main_banner_img" name="main_banner_img" value="{{$indexData->main_banner_img}}">
                    @error('main_banner_img')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" ps-3">
                    <img src="/images/{{$indexData->main_banner_img}}" alt="Image not found" style="width: 100%;" class="rounded">
                </div>
            </div>
    
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</main>
@endsection

