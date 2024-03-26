@extends('customer.layout')
@section('title', 'Billing Address | Art Gallery')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>{{ __('messages.BillingAddress') }}</h1>
  </div>
  @if(Session::has('flash_message'))
    <div class="alert alert-success" style="width: fit-content;">
        <span>{{ Session::get('flash_message') }}</span>
    </div>
  @endif

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <form class="row g-3 p-3" action="{{ route('billing.update') }}" method="post">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="inputAddress" class="form-label">{{ __('messages.Address') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputAddress" name="b_address_one" value="{{ old('b_address_one', $billing->b_address_one ?? '') }}" required>
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">{{ __('messages.Address2') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputAddress2" name="b_address_two" value="{{ old('b_address_two', $billing->b_address_two ?? '') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="inputCity" class="form-label">{{ __('messages.City') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputCity" name="b_city" value="{{ old('b_city', $billing->b_city ?? '') }}" required>
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">{{ __('messages.State') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputState" name="b_state" value="{{ old('b_state', $billing->b_state ?? '') }}" required>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">{{ __('messages.Zip') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputZip" name="b_zip" value="{{ old('b_zip', $billing->b_zip ?? '') }}" required>
                </div>
                <div class="col-md-3">
                    <label for="inputCountry" class="form-label">{{ __('messages.Country') }}<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inputCountry" name="b_country" value="{{ old('b_country', $billing->b_country ?? '') }}" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">{{ __('messages.Submit') }}</button>
                </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

</main>

<script>
  $(document).ready(function () {
      @if(session('success'))
          toastr.success('{{ session('success') }}');
      @endif
  });
</script>


@endsection