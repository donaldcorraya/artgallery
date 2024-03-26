@extends('customer.layout')
@section('title', 'Dashboard | Art Gallery')
@section('content')


<main id="main" class="main">
  <div class="pagetitle">
    @if(Session::has('flash_message'))
    <br><br>
    <div class="alert alert-success">
      <h5>{{ Session::get('flash_message') }}</h5>
    </div>
    @endif

    @if(Session::has('error'))
    <br><br>
    <div class="alert alert-danger">
      <h5>{{ Session::get('error') }}</h5>
    </div>
    @endif
    <h1>{{ __('messages.Profile') }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a
            href="{{ auth()->user()->role == 2 ? '/customer_dashboard' : '/dashboard' }}">{{ __('messages.Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('messages.user') }}</li>
        <li class="breadcrumb-item active">{{ __('messages.Profile') }}</li>
      </ol>
    </nav>
  </div>

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <?php if(isset($data->image)){ ?>            
              <img  src="<?= asset($data->image) ?>" alt="Profile" class="rounded-circle">
            <?php }else{ ?>
              <img src="{{ file_exists($data->image)? asset($data->image) : asset('storage/images/dummy-image.jpg') }}"
                        alt="Profile" class="img-fluid">
              <?php } ?>
            <h2>{{ $data->name }}</h2>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab"
                  data-bs-target="#profile-overview">{{ __('messages.Overview') }}</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">{{ __('messages.EditProfile') }}</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">{{ __('messages.ChangePassword') }}</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">{{ __('messages.ProfileDetails') }}</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">{{ __('messages.firstName') }}</div>
                  <div class="col-lg-9 col-md-8">{{ $data->firstName ?? '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">{{ __('messages.lastName') }}</div>
                  <div class="col-lg-9 col-md-8">{{ $data->lastName ?? '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.Phone') }}</div>
                  <div class="col-lg-9 col-md-8">{{ $data->phone ?? '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.Email') }}</div>
                  <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.Birth') }}</div>
                  <div class="col-lg-9 col-md-8">{{ $data->date_of_birth ?? '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.Gender') }}</div>
                  <div class="col-lg-9 col-md-8">{{ $data->gender ?? '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.Address') }}</div>
                  <div class="col-lg-9 col-md-8">{{ isset($address->b_address_one)? $address->b_address_one : '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.Address_2') }}</div>
                  <div class="col-lg-9 col-md-8">{{ isset($address->b_address_two)? $address->b_address_two : '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.City') }}</div>
                  <div class="col-lg-9 col-md-8">{{ isset($address->b_city)? $address->b_city : '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.State') }}</div>
                  <div class="col-lg-9 col-md-8">{{ isset($address->b_state)? $address->b_state : '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.PostCode') }}</div>
                  <div class="col-lg-9 col-md-8">{{ isset($address->b_zip)? $address->b_zip : '' }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">{{ __('messages.Country') }}</div>
                  <div class="col-lg-9 col-md-8">{{ isset($address->b_country)? $address->b_country : '' }}</div>
                </div>
              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="post" action="{{ url('customer/'.$data->id) }}" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  {{ method_field('PUT') }}
                  <input type="hidden" name="old_img" value="{{ file_exists($data->image)? $data->image : '' }}">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Image') }}</label>
                    <div class="col-md-8 col-lg-9">

                      <img
                        src="{{ file_exists($data->image)? asset($data->image) : asset('storage/images/dummy-image.jpg') }}"
                        alt="Profile" class="img-fluid">

                      <div class="pt-2">
                        <input name="image" type="file" class="form-control" id="profileImage">
                      </div>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="firstName" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.firstName') }} <span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="firstName" type="text" class="form-control" id="firstName"
                        value="{{ $data->firstName }}" required>
                      <b><small class="text-danger">{{ $errors->first('firstName') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.lastName') }}<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="lastName" type="text" class="form-control" id="lastName"
                        value="{{ $data->lastName }}" required>
                      <b><small class="text-danger">{{ $errors->first('lastName') }}</small></b>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Phone') }}<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="number" class="form-control" id="phone" value="{{ $data->phone }}" required>
                      <b><small class="text-danger">{{ $errors->first('phone') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Email') }}<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email" value="{{ auth()->user()->email }}" required>
                      <b><small class="text-danger">{{ $errors->first('email') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Birth') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="date_of_birth" type="date" class="form-control" id="date_of_birth"
                        value="{{ $data->date_of_birth }}">
                      <b><small class="text-danger">{{ $errors->first('date_of_birth') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="gender" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Gender') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <select name="gender" class="form-select">
                        <option value="">Select</option>
                        <option value="Male" <?=($data->gender =='Male' )? 'Selected' : '' ?>>{{ __('messages.Male') }}</option>
                        <option value="Famale" <?=($data->gender =='Famale' )? 'Selected' : '' ?>>{{ __('messages.Famale') }}</option>
                      </select>
                      <b><small class="text-danger">{{ $errors->first('gender') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="address_one" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Address') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address_one" type="text" class="form-control" id="address_one"
                        value="{{ isset($address->b_address_one)? $address->b_address_one : '' }}">
                      <b><small class="text-danger">{{ $errors->first('address_one') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="address_two" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Address_2') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address_two" type="text" class="form-control" id="address_two"
                        value="{{ isset($address->b_address_two)? $address->b_address_two : '' }}">
                      <b><small class="text-danger">{{ $errors->first('address_two') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="city" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.City') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="city" type="text" class="form-control" id="city" value="{{ isset($address->b_city)? $address->b_city : '' }}">
                      <b><small class="text-danger">{{ $errors->first('city') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="state" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.State') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="state" type="text" class="form-control" id="state" value="{{ isset($address->b_state)? $address->b_state : '' }}">
                      <b><small class="text-danger">{{ $errors->first('state') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="post" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.PostCode') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="post" type="text" class="form-control" id="post" value="{{ isset($address->b_zip)? $address->b_zip : '' }}">
                      <b><small class="text-danger">{{ $errors->first('post') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="country" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Country') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="country" type="text" class="form-control" id="country"
                        value="{{ isset($address->b_country)? $address->b_country : '' }}">
                      <b><small class="text-danger">{{ $errors->first('country') }}</small></b>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ __('messages.SaveChanges') }}</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="post" action="{{ route('customer.update',$data->id)}}">
                  {!! csrf_field() !!}
                  <input type="hidden" name='id' value="{{ $data->id }}">
                  {{ method_field('PUT') }}
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.CurrentPassword') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="current_password" type="password" class="form-control" id="currentPassword">
                      <b><small class="text-danger">{{ $errors->first('current_password') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.NewPassword') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new_password" type="password" class="form-control" id="newPassword">
                      <b><small class="text-danger">{{ $errors->first('new_password') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.ConfirmPassword') }}</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new_password_confirmation" type="password" class="form-control" id="renewPassword">
                      <b><small class="text-danger">{{ $errors->first('new_password_confirmation') }}</small></b>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ __('messages.SaveChanges') }}</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>


</main>
@endsection