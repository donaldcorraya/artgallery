@extends('admin.layout')
@section('title', 'SEO Setting')
@section('content')
<section id="main" class="main dashboard">
    <form action="{{ route('seo-setting-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-5">
                            <label for="inputText" class="col-sm-2 col-form-label">Meta Title <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Meta Title" class="form-control" required
                                    value="{{ $general->meta_title }}" name="meta_title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Meta Description <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="meta_description"
                                    placeholder="Meta Description" value="{{ $general->meta_description }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Meta Image </label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="meta_image">
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-end">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
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

@push('script')
<script>
    @foreach($errors -> all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
</script>
@endpush