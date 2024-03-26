@extends('admin.layout')
@section('title', 'Menu Create')
@section('content')

<section class="section main" id="main">
    <form action="{{ route('menus.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Menu Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="title" class="form-control" value="{{ $item->name }}">
                            </div>
                        </div>
                        
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Parent Menu </label>
                            <div class="col-sm-10">
                                <select name="parent_id" class="form-control" id="myDropdown">
                                    <option value="0">Main Menu</option>
                                    @foreach($menus as $menu)
                                    <option {{ $item->parent_id == $menu->id ? 'selected' : ''  }} value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-5" id="myDiv">
                            <label for="inputText" class="col-sm-2 col-form-label">Page <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="url" id="" class="form-control">
                                    @foreach($pages as $page)
                                    <option {{ $item->url == $page->slug ? 'selected' : "" }} value="{{ $page->slug }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Status </label>
                            <div class="col-sm-10">
                                <select name="status" id="" class="form-control">
                                    <option {{ $item->status == 1 ? "selected" : '' }} value="1">Enable</option>
                                    <option {{ $item->status == 0 ? "selected" : '' }} value="0">Disable</option>
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
