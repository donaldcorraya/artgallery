@extends('admin.layout')
@section('title', 'Coupon Details | Art Gallery')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Coupon</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/coupon')}}">Coupon</a></li>
        <li class="breadcrumb-item active">View</li>
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

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Code</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->code }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Name</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Description</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->description }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Max Uses</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->max_uses }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Type</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->type }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Discount Amount</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->discount_amount }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Max Amount</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->max_amount }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Min Amount</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->min_amount }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Status</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->status }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Starts At</div>
                  <div class="col-lg-9 col-md-8">{{ date('m/d/Y', $arr->starts_at) }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Expires At</div>
                  <div class="col-lg-9 col-md-8">{{ date('m/d/Y', $arr->expires_at) }}</div>
                </div>

               


              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <form action="{{ route('coupon.update',$arr->id) }}" method="POST" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  {{ method_field('PUT') }}


                  <div class="row mb-3">
                    <label for="code" class="col-md-4 col-lg-3 col-form-label">code<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="code" type="text" class="form-control" id="code" value="{{ $arr->code }}" required>
                      <b><small class="text-danger">{{ $errors->first('code') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">name<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="{{ $arr->name }}" required>
                      <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="description" class="col-md-4 col-lg-3 col-form-label">description<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="description" type="text" class="form-control" id="description" value="{{ $arr->description }}" required>
                      <b><small class="text-danger">{{ $errors->first('description') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="max_uses" class="col-md-4 col-lg-3 col-form-label">max_uses<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="max_uses" type="text" class="form-control" id="max_uses" value="{{ $arr->max_uses }}" required>
                      <b><small class="text-danger">{{ $errors->first('max_uses') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="max_uses_user" class="col-md-4 col-lg-3 col-form-label">max_uses_user<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="max_uses_user" type="text" class="form-control" id="max_uses_user" value="{{ $arr->max_uses_user }}" required>
                      <b><small class="text-danger">{{ $errors->first('max_uses_user') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="type" class="col-md-4 col-lg-3 col-form-label">type<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select" name="type" aria-label="Default select example">
                          <option value="fixed" <?=($arr->type == 'fixed')? 'selected' : ''?>>Fixed</option>
                          <option value="percent" <?=($arr->type == 'percent')? 'selected' : ''?>>Percent</option>
                      </select
                      <b><small class="text-danger">{{ $errors->first('type') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="discount_amount" class="col-md-4 col-lg-3 col-form-label">discount_amount<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="discount_amount" type="text" class="form-control" id="discount_amount" value="{{ $arr->discount_amount }}" required>
                      <b><small class="text-danger">{{ $errors->first('discount_amount') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="max_amount" class="col-md-4 col-lg-3 col-form-label">max_amount<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="max_amount" type="text" class="form-control" id="max_amount" value="{{ $arr->max_amount }}" required>
                      <b><small class="text-danger">{{ $errors->first('max_amount') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="min_amount" class="col-md-4 col-lg-3 col-form-label">min_amount<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="min_amount" type="text" class="form-control" id="min_amount" value="{{ $arr->min_amount }}" required>
                      <b><small class="text-danger">{{ $errors->first('min_amount') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="status" class="col-md-4 col-lg-3 col-form-label">status</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="status" type="text" class="form-control" id="status" value="{{ $arr->status }}">
                      <b><small class="text-danger">{{ $errors->first('status') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="starts_at" class="col-md-4 col-lg-3 col-form-label">starts_at<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="starts_at" type="text" class="form-control" id="starts_at" value="{{ date('m/d/Y', $arr->starts_at) }}" required>
                      <b><small class="text-danger">{{ $errors->first('starts_at') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="expires_at" class="col-md-4 col-lg-3 col-form-label">expires_at<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="expires_at" type="text" class="form-control" id="expires_at" value="{{ date('m/d/Y', $arr->expires_at) }}" required>
                      <b><small class="text-danger">{{ $errors->first('expires_at') }}</small></b>
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
    $("#expires_at").datepicker({
        format: 'Y-m-d H:i:s',
    });

    $("#starts_at").datepicker({
        format: 'Y-m-d H:i:s',
    });
</script>
@endsection