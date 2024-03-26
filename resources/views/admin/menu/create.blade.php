@extends('admin.layout')
@section('title', 'Menu Create')
@section('content')
<section class="section main" id="main">
    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Menu Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="title" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Parent Menu </label>
                            <div class="col-sm-10">
                                <select name="parent_id" class="form-control" id="myDropdown">
                                    <option value="0">Main Menu</option>
                                    @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="row mb-3 mt-5" id="myDiv">
                            <label for="inputText" class="col-sm-2 col-form-label">Page <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="url" class="form-control">
                                    @foreach($pages as $item)
                                    <option value="{{ $item->slug }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Status </label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-5 mt-5">
                        <label for="inputPassword" class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <a class="btn btn-danger" style="margin-right: 10px" href="{{ route('menus.index') }}">Cancel </a>
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
