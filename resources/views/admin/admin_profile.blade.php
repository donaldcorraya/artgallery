@extends('admin.layout')
@section('title', 'Profile Update | Art Gallery')
@section('content')


<main id="main" class="main">
    <div class="d-flex justify-content-between">
        <div class="pagetitle">

            <h1>Profile Update</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </nav>
        </div>
        <div class="text-end pt-2">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i> View
                Data</a>
        </div>
    </div>

    <div class="Profile" style="margin: -10px;">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin_profile.update', $indexData->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12"><h5 class="card-title">Profile Update</h5></div>

                    <div class="row">
                        <div class="col-md-6 g-1 py-3 px-2">
                            <label for="name" class="form-label ps-1">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$indexData->name}}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 g-1 py-3 px-2">
                            <label for="email" class="form-label ps-1">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$indexData->email}}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class=" text-end g-1 pb-3">
                        <button type="submit" class="btn btn-primary fw-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin_password.update') }}">
                    @csrf
                    <div class="col-lg-12"><h5 class="card-title">Password Update</h5></div>
                    <div class="row g-1 py-3 px-2">
                        <label for="current_password" class="form-label ps-1">Current Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 g-1 py-3 px-2">
                            <label for="password" class="form-label ps-1">New Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 g-1 py-3 px-2">
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="text-end g-1 pb-3">
                        <button type="submit" class="btn btn-primary fw-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

