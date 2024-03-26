@extends('admin.layout')
@section('title', 'Blog Details | Art Gallery')
@section('content')
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

<style>
  .meta_img{
    width: 120px;
    height: auto;
  }
</style>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Blog</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/blog')}}">Blog</a></li>
        <li class="breadcrumb-item active">View</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="{{ file_exists($arr->banner)? asset($arr->banner) : asset('storage/images/dummy-image.jpg') }}" alt="Profile" class="img-fluid">
            <h2>{{ $arr->name }}</h2>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Title</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->title }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Category</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->category->name }}</div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Slug</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->slug }}</div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Short Description</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->short_description }}</div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Long Description</div>
                  <div class="col-lg-9 col-md-8">{!! $arr->long_description !!}</div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Meta Title</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->meta_title }}</div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Meta Image</div>
                  <div class="col-lg-9 col-md-8">
                      <img class="meta_img" src="{{ asset($arr->meta_image) }}">
                  </div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Meta Description</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->meta_description }}</div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Meta Keyword</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->meta_keyword }}</div>
                </div>     

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Status</div>
                  <div class="col-lg-9 col-md-8">{{ ($arr->status == 1)? 'active' : 'Inactive' }}</div>
                </div>     


              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{ url('blog/'. $arr->id) }}" method="POST" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Banner</label>
                    <div class="col-md-8 col-lg-9">

                      <img src="{{ file_exists($arr->banner)? asset($arr->banner) : asset('storage/images/dummy-image.jpg') }}" alt="Profile" class="img-fluid">

                      <div class="pt-2">
                        <input name="banner" type="file" class="form-control" id="profileImage">
                      </div>
                    </div>
                  </div>

                  {!! csrf_field() !!}
                  {{ method_field('PUT') }}

                  <input type="hidden" name='old_banner' value="{{ $arr->banner }}">

                  <div class="row mb-3">
                    <label for="title" class="col-md-4 col-lg-3 col-form-label">Title<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="title" type="text" class="form-control" id="title" value="{{ $arr->title }}" required>
                      <b><small class="text-danger">{{ $errors->first('title') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="category" class="col-md-4 col-lg-3 col-form-label">Category<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">

                        <select name="category_id" class="form-select" aria-label="Default select example" id="category_id">
                            @foreach($categories_arr as $category)
                                <option value="{{ $category->id }}" {{ ($category->id == $arr->category_id)? 'selected' : '' }}>{{ $category->name }}</option>      
                            @endforeach                                                                  
                        </select>
                        <b><small class="text-danger">{{ $errors->first('category_id') }}</small></b>                      
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
                    <label for="short_description" class="col-md-4 col-lg-3 col-form-label">Short Description<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="short_description" type="text" class="form-control" id="short_description" value="{{ $arr->short_description }}" required>
                      <b><small class="text-danger">{{ $errors->first('short_description') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="long_description" class="col-md-4 col-lg-3 col-form-label">Long Description<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <textarea type="text" value="{{ old('long_description') }}" name="long_description" class="form-control" id="editor" required>
                      {{ $arr->long_description }}
                      </textarea>
                      <b><small class="text-danger">{{ $errors->first('long_description') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="meta_title" class="col-md-4 col-lg-3 col-form-label">Meta Title<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="meta_title" type="text" class="form-control" id="meta_title" value="{{ $arr->meta_title }}" required>
                      <b><small class="text-danger">{{ $errors->first('meta_title') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="meta_image" class="col-md-4 col-lg-3 col-form-label">Meta Image</label>
                    <div class="col-md-8 col-lg-9">

                      <img src="{{ file_exists($arr->meta_image)? asset($arr->meta_image) : asset('storage/images/dummy-image.jpg') }}" alt="Profile" class="img-fluid">

                      <div class="pt-2">
                        <input name="meta_image" type="file" class="form-control" id="profileImage">
                        <input name="old_meta_image" type="hidden" class="form-control" value="{{ $arr->meta_image }}">
                      </div>
                      <b><small class="text-danger">{{ $errors->first('meta_image') }}</small></b>

                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="meta_description" class="col-md-4 col-lg-3 col-form-label">Meta Description<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="meta_description" type="text" class="form-control" id="meta_description" value="{{ $arr->meta_description }}" required>
                      <b><small class="text-danger">{{ $errors->first('meta_description') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="meta_keyword" class="col-md-4 col-lg-3 col-form-label">Meta Keyword<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="meta_keyword" type="text" class="form-control" id="meta_keyword" value="{{ $arr->meta_keyword }}" required>
                      <b><small class="text-danger">{{ $errors->first('meta_keyword') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Status</label>
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

              <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<script>
  CKEDITOR.replace('editor', {
      skin: 'moono',
      enterMode: CKEDITOR.ENTER_BR,
      shiftEnterMode:CKEDITOR.ENTER_P,
      toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
                  { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                  { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
                  { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                  { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                  { name: 'links', items: [ 'Link', 'Unlink' ] },
                  { name: 'insert', items: [ 'Image'] },
                  { name: 'spell', items: [ 'jQuerySpellChecker' ] },
                  { name: 'table', items: [ 'Table' ] }
                  ],
      });

      $("#title").keyup(function() {
            var txt = $("#title").val();
            txt = txt.replace(/\s+/g, '-').toLowerCase();
            $("#slug").val(txt);
        });

</script>
@endsection