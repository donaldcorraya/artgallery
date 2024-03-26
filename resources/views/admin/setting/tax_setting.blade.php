@extends('admin.layout')
@section('title', 'Tax Setting')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">

        @if(session('flash_message'))
            <p class="alert alert-success text-center" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">{{session('flash_message')}}</p>
        @endif


        <h1>Tax</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Tax</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title ">Tax</h5>  
                        <form action="{{ route('tax-update', $arr['id']) }}" method="POST">                      
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-lg-8 mb-3">
                                    <div class="col-lg-12">
                                        <input class="form-control" value="{{ $arr['tax'] }}" name="tax" type="text" placeholder="Tax">
                                        <b><small class="text-danger">{{ $errors->first('tax') }}</small></b>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 mb-3">
                                    <button type="submit" class="form-control btn btn-primary">Save</button>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

@endsection

@push('script')
<script>
    @foreach($errors -> all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
</script>
@endpush