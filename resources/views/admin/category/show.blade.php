@extends('admin.layout')
@section('title', 'Category Edit | Art Gallery')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Category</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/category')}}">Category</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      

      <div class="col-xl-12">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <!-- Profile Edit Form -->
                <form action="{{ url('category/'. $arr->id) }}" method="POST" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image</label>
                    <div class="col-md-8 col-lg-9">

                      <img src="{{ asset($arr->image) }}" alt="Profile" class="img-fluid">

                      <div class="pt-2">
                        <input name="image" type="file" class="form-control" id="profileImage">
                        <b><small class="text-danger">{{ $errors->first('image') }}</small></b>
                      </div>
                    </div>
                  </div>

                  {!! csrf_field() !!}
                  {{ method_field('PUT') }}

                  <input type="hidden" name='old_img' value="{{ $arr->image }}">

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="{{ $arr->name }}" required>
                      <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="slug" class="col-md-4 col-lg-3 col-form-label">Slug<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="slug" type="text" class="form-control" id="slug" value="{{ $arr->slug }}" required>
                      <b><small class="text-danger">{{ $errors->first('slug') }}</small></b>
                    </div>
                  </div>
                  

                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Status</label>
                    <div class="col-md-8 col-lg-9">

                      <select id="inputState" class="form-select" name="status">
                          <option <?= ($arr->status == 1)? 'selected' : '' ?> value="1">Active</option>
                          <option <?= ($arr->status == 0)? 'selected' : '' ?> value="0">Inactive</option>
                      </select>
                      <b><small class="text-danger">{{ $errors->first('status') }}</small></b>
                    </div>
                  </div>


                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              

            </div><!-- End Bordered Tabs -->

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