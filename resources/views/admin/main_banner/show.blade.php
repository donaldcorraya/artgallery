@extends('admin.layout')
@section('title', 'Main Banner Details | Art Gallery')
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
    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-header">
        Banner Details
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>{{$indexData->main_banner_title}}</p>
            <footer class="blockquote-footer">{{$indexData->main_banner_tagline}}<cite title="Source Title">Source Title</cite></footer>
          </blockquote>
        </div>
        <div class=" ps-3">
            <img src="/images/{{$indexData->main_banner_img}}" alt="Image not found" style="width: 100%;" class="rounded">
        </div>
      </div>

</main>
@endsection

