@extends('frontend.layout')
@section('title', 'Customer | Art Gallery')
@section('content')
<!--===========================register part start===================================-->

<section class="user_register_form">
	<div class="bg-light py-3 py-md-5">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
					<div class="bg-white p-4 p-md-3 rounded shadow-sm">
						<div class="row">
							<div class="col-12">
								<div class="text-center mb-3">
									<a href="{{ route('home') }}" class="logo">
										@if(isset(gs()->logo))
										<img src="{{ asset('assets/images/setting/'.gs()->logo) }}" alt="">
										@endif
									</a>
								</div>
							</div>
						</div>
						<form action="{{ route('customer-registraion') }}" method="post">
							@csrf
							<div class="row gy-3 gy-md-4 overflow-hidden">
								<div class="col-12">
									<label for="firstName" class="form-label">{{ __('messages.firstName') }}<span
											class="text-danger">*</span></label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fa-regular fa-address-card"></i>
										</span>
										<input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name"
											required>
									</div>
									<span class="text-danger">{{ $errors->first('firstName') }}</span>
								</div>
								<div class="col-12">
									<label for="lastName" class="form-label">{{ __('messages.lastName') }}<span
											class="text-danger">*</span></label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fa-regular fa-credit-card"></i>
										</span>
										<input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
									</div>
									<span class="text-danger">{{ $errors->first('lastName') }}</span>
								</div>
								<div class="col-12">
									<label for="email" class="form-label">{{ __('messages.Email') }} <span
											class="text-danger">*</span></label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fa-regular fa-envelope"></i>
										</span>
										<input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
									</div>
									<span class="text-danger">{{ $errors->first('email') }}</span>
								</div>
								<div class="col-12">
									<label for="password" class="form-label">{{ __('messages.Password') }} <span
											class="text-danger">*</span></label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fa-solid fa-key"></i>
										</span>
										<input type="password" class="form-control" name="password" placeholder="Enter your password" id="password"
											value="" required>
									</div>
									<span class="text-danger">{{ $errors->first('password') }}</span>
								</div>
								<div class="col-12">
									<label for="password_confirmation" class="form-label">{{ __('messages.ConfirmPassword') }} <span class="text-danger">*</span></label>
									<div class="input-group">
										<span class="input-group-text">
											<i class="fa-solid fa-key"></i>
										</span>
										<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" placeholder="Enter your confirm password" required>
									</div>
									<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
								</div>
								<div class="col-12">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" name="iAgree"
											id="iAgree" required>
										<label class="form-check-label text-secondary" for="iAgree">
											{{ __('messages.agree') }} <a href="#!" class="text-decoration-none">{{ __('messages.terms') }}</a>
										</label>
									</div>
								</div>
								<div class="col-12">
									<div class="d-grid">
										<button class="btn btn-lg" type="submit">{{ __('messages.SignUp') }}</button>
									</div>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-12">
								<hr class="mt-5 mb-4 border-secondary-subtle">
								<p class="m-0 text-secondary text-center">{{ __('messages.Already') }}<a
										href="{{ route('customer-login') }}" class="text-decoration-none"> {{ __('messages.Log') }}</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--===========================register part end===================================-->
@endsection

@push('script')
<script>
	@foreach($errors -> all() as $error)
	toastr.error("{{ $error }}");
	@endforeach
</script>
@endpush