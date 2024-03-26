@extends('frontend.layout')
@section('title', 'Customer | Art Gallery')
@section('content')

<Style>
  .login{
    text-align: justify;
  }
</Style>

<section class=" user_register_form">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <div class="">
                    <a href="{{ route('home') }}" class="logo">
                      @if(isset(gs()->logo))
                      <img src="{{ asset('assets/images/setting/'.gs()->logo) }}" alt="">
                      @endif
                      </a>
                  </div>
                  <h4 class="mt-1 mb-5 pb-1">{{ __('messages.Login') }}</h4>
                  @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                </div>
                <form method="post" action="{{ route('customer-post-login')}}">
                  {!! csrf_field() !!}
                  <div class="form-outline mb-4">
                    <label class="form-label" for="user">{{ __('messages.Username') }}</label>
                    <input type="email" name="email" id="user" class="form-control"
                      placeholder="Phone number or email address" />
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="pass">{{ __('messages.Password') }}</label>
                    <input type="password" name="password" id="pass" class="form-control" placeholder="Enter your password" />
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1 loginbtn">
                    <button class="btn mb-3" type="submit">{{ __('messages.Log') }}</button>
                    <a class="text-muted" href="{{ route('forget.password.request') }}">{{ __('messages.Forgotpassword') }}</a>
                  </div>
                </form>
                <div class="d-flex align-items-center justify-content-center pb-4">
                  <p class="mb-0 me-2">{{ __('messages.Login') }}</p>
                  <a href="{{ route('customer.register') }}">{{ __('messages.CreatenewAccount') }}</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center btnblock">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4 text-center">{{ __('messages.WellcometoArtGallery') }}</h4>
                <p class="small mb-0 login">{{ __('messages.WellcomeMessage') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('script')
<script>
  @foreach($errors->all() as $error)
  toastr.error("{{ $error }}");
  @endforeach
</script>
@endpush