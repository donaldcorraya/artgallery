@extends('admin.layout')
@section('title', 'Product Create | Art Gallery')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

<style>
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

    .form-control{
        margin-bottom: 20px;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/product')}}">Product</a></li>
                <li class="breadcrumb-item active">Add New</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="col-lg-12"><h5 class="card-title">Add New</h5></div>
                        <div class="col-lg-6">

                            <div class="col-12">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" required>
                                <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="slug" class="form-label">Slug<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('slug') }}" name="slug" class="form-control" id="slug" required>
                                <b><small class="text-danger">{{ $errors->first('slug') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="size" class="form-label">Dimension<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('size') }}" name="size" class="form-control" id="size" required>
                                <b><small class="text-danger">{{ $errors->first('size') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="regular_price" class="form-label">Regular Price<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('regular_price') }}" name="regular_price" class="form-control" id="regular_price" required>
                                <b><small class="text-danger">{{ $errors->first('regular_price') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="selling_price" class="form-label">Selling Price<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('selling_price') }}" name="selling_price" class="form-control" id="selling_price" required>
                                <b><small class="text-danger">{{ $errors->first('selling_price') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="stock_amount" class="form-label">Stock Amount<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('stock_amount') }}" name="stock_amount" class="form-control" id="stock_amount" required>
                                <b><small class="text-danger">{{ $errors->first('stock_amount') }}</small></b>
                            </div>

                            <div class="col-12" style="display: grid;">
                                <label for="short_description" class="form-label">Short Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="short_description" cols="30" rows="1" required></textarea>
                                <b><small class="text-danger">{{ $errors->first('short_description') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="weight" class="form-label">Wight<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('weight') }}" name="weight" class="form-control" id="weight" required>
                                <b><small class="text-danger">{{ $errors->first('weight') }}</small></b>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="col-12">
                                <label for="product_code" class="form-label">Product Code<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('product_code') }}" name="product_code" class="form-control" id="product_code" required>
                                <b><small class="text-danger">{{ $errors->first('product_code') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="product_materials" class="form-label">Product Medium / Materials<span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('product_materials') }}" name="product_materials" class="form-control" id="product_materials" required>
                                <b><small class="text-danger">{{ $errors->first('product_materials') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="architect_id" class="form-label">Architect<span class="text-danger">*</span></label>
                                <select name="architect_id" class="form-select form-control" aria-label="Default select example" id="architect_id" required>
                                    @foreach($architect_arr as $architect)
                                    <option value="{{ $architect->id }}">{{ $architect->name }}</option>
                                    @endforeach
                                </select>
                                <b><small class="text-danger">{{ $errors->first('architect_id') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="category_id" class="form-label">Categories<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select form-control" aria-label="Default select example" id="category_id" required>
                                    @foreach($categories_arr as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <b><small class="text-danger">{{ $errors->first('category_id') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Thumbnail<span class="text-danger">*</span></label>
                                <input type="file" value="{{ old('image') }}" name="image" class="form-control" id="inputNanme4" required>
                                <b><small class="text-danger">{{ $errors->first('image') }}</small></b>
                            </div>


                            <div class="col-12">
                                <div class="upload__box">
                                    <div class="upload__btn-box">
                                        <label class="upload__btn">
                                            <p>Banner Image<span class="text-danger">*</span></p>
                                            <input name="otherImage[]" type="file" multiple="multiple" data-max_length="20" class="upload__inputfile" required>
                                            <p><b><small class="text-danger">{{ $errors->first('otherImage[]') }}</small></b></p>
                                        </label>
                                    </div>
                                    <div class="upload__img-wrap"></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="meta_tag" class="form-label">Meta Tag</label>
                                <input type="text" value="{{ old('meta_tag') }}" name="meta_tag" class="form-control" id="meta_tag">
                                <b><small class="text-danger">{{ $errors->first('meta_tag') }}</small></b>
                            </div>

                            <div class="col-12">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text" value="{{ old('meta_description') }}" name="meta_description" class="form-control" id="meta_description">
                                <b><small class="text-danger">{{ $errors->first('meta_description') }}</small></b>
                            </div>



                        </div>

                        <div class="col-lg-12">
                            <div class="col-12 pb-4" style="display: grid;">
                                <label for="long_description" class="form-label">Long Description<span class="text-danger">*</span></label>
                                <textarea name="long_description" id="editor" cols="30" rows="10" required></textarea>
                                <b><small class="text-danger">{{ $errors->first('long_description') }}</small></b>
                            </div>



                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
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

    $(document).ready(function() {

        $('select[name="category_id"]').on("change", function() {
            let category_id = $('select[name="category_id"]').val();

            $.ajax({
                type: 'GET',
                url: '/get_sub_category',
                data: {
                    'category_id': category_id
                },
                dataType: 'html',
                success: function(data) {
                    $('select[name="sub_category_id"]').html(data)
                },
                error: function() {
                    //console.log(data);
                }
            });
        });

    });

    CKEDITOR.replace('editor', {
        skin: 'moono',
        enterMode: CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
        toolbar: [{
                name: 'basicstyles',
                groups: ['basicstyles'],
                items: ['Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor']
            },
            {
                name: 'styles',
                items: ['Format', 'Font', 'FontSize']
            },
            {
                name: 'scripts',
                items: ['Subscript', 'Superscript']
            },
            {
                name: 'justify',
                groups: ['blocks', 'align'],
                items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink']
            },
            {
                name: 'insert',
                items: ['Image']
            },
            {
                name: 'spell',
                items: ['jQuerySpellChecker']
            },
            {
                name: 'table',
                items: ['Table']
            }
        ],
    });


    $("#name").keyup(function() {
        var txt = $("#name").val();
        txt = txt.replace(/\s+/g, '-').toLowerCase();
        $("#slug").val(txt);
    });
</script>
@endsection