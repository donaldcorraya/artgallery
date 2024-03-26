@extends('admin.layout')
@section('title', 'Architect Details | Art Gallery')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Architect</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/architect')}}">Architect</a></li>
        <li class="breadcrumb-item active">View</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ asset($arr->image) }}" alt="Profile" class="img-fluid">


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
                  <div class="col-lg-3 col-md-4 label ">Name</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Email</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->email }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Phone</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->phone }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Address</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->address }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Details</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->description }}</div>
                </div>


              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{ url('architect/'. $arr->id) }}" method="POST" enctype="multipart/form-data">
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

                  <input type="hidden" name='old_img' value="{{ $arr->image }}" required>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="{{ $arr->name }}" required>
                      <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email" value="{{ $arr->email }}" required>
                      <b><small class="text-danger">{{ $errors->first('email') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="number" class="form-control" id="phone" value="{{ $arr->phone }}" required>
                      <b><small class="text-danger">{{ $errors->first('phone') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Address<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="fullName" value="{{ $arr->address }}" required>
                      <b><small class="text-danger">{{ $errors->first('address') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="description" class="col-md-4 col-lg-3 col-form-label">Description<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="description" type="text" class="form-control" id="description" value="{{ $arr->description }}" required>
                      <b><small class="text-danger">{{ $errors->first('description') }}</small></b>
                    </div>
                  </div>
                  

                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Status<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">

                      <select id="inputState" class="form-select" name="status" required>
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
@endsection