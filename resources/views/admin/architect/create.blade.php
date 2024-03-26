@extends('admin.layout')
@section('title', 'Architect Add | Art Gallery')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />

<style>
    .color_name {
        width: 90px;
    }

    .color_code {
        width: 40px;
        height: 20px;
    }

    /* upload image css */
    .upload {
        &__box {
            padding: 40px;
        }

        &__inputfile {
            width: .1px;
            height: .1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        &__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all .3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;

            &:hover {
                background-color: unset;
                color: #4045ba;
                transition: all .3s ease;
            }

            &-box {
                margin-bottom: 10px;
            }
        }

        &__img {
            &-wrap {
                display: flex;
                flex-wrap: wrap;
                margin: 0 -10px;
            }

            &-box {
                width: 200px;
                padding: 0 10px;
                margin-bottom: 12px;
            }

            &-close {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background-color: rgba(0, 0, 0, 0.5);
                position: absolute;
                top: 10px;
                right: 10px;
                text-align: center;
                line-height: 24px;
                z-index: 1;
                cursor: pointer;

                &:after {
                    content: '\2716';
                    font-size: 14px;
                    color: white;
                }
            }
        }
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }

    .upload__img-box {
        width: 171px;
        height: auto;
        float: left;
        margin-right: 10px;
        margin-top: 10px;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after {
        content: "✖";
        font-size: 14px;
        color: white;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Architect</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/architect')}}">Architect</a></li>
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New</h5>

                        <form class="row g-3" action="{{ route('architect.store') }}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="col-12">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" required>
                                <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                            </div>                            

                            <div class="col-12">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email" required>
                                <b><small class="text-danger">{{ $errors->first('email') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="number" value="{{ old('phone') }}" name="phone" class="form-control" id="phone" required>
                                <b><small class="text-danger">{{ $errors->first('phone') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea type="text" name="address" class="form-control" id="address" required>{{ old('address') }}</textarea>
                                <b><small class="text-danger">{{ $errors->first('address') }}</small></b>
                            </div>
							
							<div class="col-12">
                                <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea type="text" name="description" class="form-control" id="description" required>{{ old('description') }}</textarea>
                                <b><small class="text-danger">{{ $errors->first('description') }}</small></b>
                            </div>
							
							<div class="col-12">
                                <label for="inputNanme4" class="form-label">Photo</label>
                                <input type="file" value="{{ old('image') }}" name="image" class="form-control" id="inputNanme4">
                                <b><small class="text-danger">{{ $errors->first('image') }}</small></b>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
    $('.select2').select2({
        //data: ["rfrews", "donald"],
        tags: true,
        maximumSelectionLength: 10,
        tokenSeparators: [',', ' '],
        placeholder: "Select or type keywords",
    });

    $(document).ready(function() {
        ImgUpload();
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function() {
            $(this).on('change', function(e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');

                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function(e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
        });
    }

    $(document).ready(function(){
        
        $('select[name="category_id"]').on("change", function(){
            let category_id = $('select[name="category_id"]').val();

            $.ajax({
                type: 'GET',
                url: '/get_sub_category',
                data : {
                    'category_id' : category_id
                },
                dataType: 'html',
                success: function (data) {
                    $('select[name="sub_category_id"]').html(data)
                },error:function(){ 
                    //console.log(data);
                }
            });            
        });
        
    });
</script>
<script>
    @if(Session::has('success_message'))
        toastr.success("{{ Session::get('success_message') }}");
    @endif
</script>
@endsection