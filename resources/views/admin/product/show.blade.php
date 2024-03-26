@extends('admin.layout')
@section('title', 'Product Details | Art Gallery')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

<style>
  .img_slider{
      width: 120px;
      height: auto;
  }

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
        background-size: cover!important;
        background-position: center!important;
        position: relative;
        padding-bottom: 100%;
    }

    .upload__img-box {
        width: 126px;
        height: auto;
        float: left;
        margin-right: 10px;
        margin-top: 10px;
        background-size: cover!important;
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
    <h1>Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/product')}}">Product</a></li>
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
                  <div class="col-lg-3 col-md-4 label ">Thumbnail</div>
                  <div class="col-lg-9 col-md-8"><img class="img_slider" src="{{ file_exists($arr->image)? asset($arr->image) : asset('storage/images/dummy-image.jpg') }}" alt="Profile" class="img-fluid"></div>
                </div>


                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Banner Images</div>
                  <div class="col-lg-9 col-md-8">
                    <?php
                      $other_img = json_decode($arr['otherImage']);
                      if(isset($other_img)){
                        foreach(json_decode($arr['otherImage']) as $othIM){?>
                          <img class="img_slider" src="{{ asset($othIM) }}">
                      <?php }
                      }
                    ?>
                  </div>
                </div> 

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Meta Tag</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->meta_tag }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Meta Description</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->meta_description }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Name</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Slug</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->slug }}</div>
                </div> 

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Dimension/Size</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->size }}</div>
                </div> 

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Regular Price</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->regular_price }}</div>
                </div> 

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Selling Price</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->selling_price }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Stock Amount</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->stock_amount }}</div>
                </div>   
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Short Description</div>
                  <div class="col-lg-9 col-md-8">{!! $arr->short_description !!}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Long Description</div>
                  <div class="col-lg-9 col-md-8">{!! $arr->long_description !!}</div>
                </div> 
                
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Weight</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->weight }}</div>
                </div> 

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Product Code</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->product_code }}</div>
                </div>                

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Product Materials</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->product_materials }}</div>
                </div>                

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Architecture</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->architect->name }}</div>
                </div>                

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Category</div>
                  <div class="col-lg-9 col-md-8">{{ $arr->category->name }}</div>
                </div>                


              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="{{ url('product/'. $arr->id) }}" method="POST" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Thumbnail</label>
                    <div class="col-md-8 col-lg-9">

                      <img src="{{ file_exists($arr->image)? asset($arr->image) : asset('storage/images/dummy-image.jpg') }}" alt="Profile" class="img-fluid">

                      <div class="pt-2">
                        <input name="image" type="file" class="form-control" id="profileImage">
                        <b><small class="text-danger">{{ $errors->first('image') }}</small></b>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">                                
                      <div class="upload__box">
                          <div class="upload__btn-box">
                              <label class="upload__btn">
                                  <p>Banner Images</p>
                                  <input name="otherImage[]" type="file" multiple="multiple" data-max_length="20" class="upload__inputfile">
                                  
                                  @foreach ($errors->get('otherImage.*') as $message)
                                      @foreach ( $message as $value)
                                          <p><b><small class="text-danger">{{ $value }}</small></b></p>
                                      @endforeach
                                  @endforeach
                                  
                              </label>
                          </div>
                          <div class="upload__img-wrap">
                          <?php
                            $other_img = json_decode($arr['otherImage']);
                            if(isset($other_img)){
                              foreach(json_decode($arr['otherImage']) as $othIM){?>
                              <div class="upload__img-box">
                                <div class="img-bg" style="background: url('{{ asset($othIM) }}');">
                                  <div class="upload__img-close"></div>
                                </div>                                
                              </div>
                              
                            <?php }
                            }
                          ?>
                          </div>
                      </div>
                  </div>

                  {!! csrf_field() !!}
                  {{ method_field('PUT') }}

                  <input type="hidden" name='old_img' value="{{ $arr->image }}">
                  <input type="hidden" name='old_otherImage' value="{{ ($arr->otherImage)? $arr->otherImage : 'null' }}">

                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="{{ $arr->name }}" required>
                      <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="slug" class="col-md-4 col-lg-3 col-form-label">Slug<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="slug" type="text" class="form-control" id="slug" value="{{ $arr->slug }}" required>
                      <b><small class="text-danger">{{ $errors->first('slug') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="meta_tag" class="col-md-4 col-lg-3 col-form-label">Meta Tag</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="meta_tag" type="text" class="form-control" id="meta_tag" value="{{ $arr->meta_tag }}">
                      <b><small class="text-danger">{{ $errors->first('meta_tag') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="meta_description" class="col-md-4 col-lg-3 col-form-label">Meta Description</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="meta_description" type="text" class="form-control" id="meta_description" value="{{ $arr->meta_description }}">
                      <b><small class="text-danger">{{ $errors->first('meta_description') }}</small></b>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label for="size" class="col-md-4 col-lg-3 col-form-label">Dimension/Size<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="size" type="text" class="form-control" id="size" value="{{ $arr->size }}" required>
                      <b><small class="text-danger">{{ $errors->first('size') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="regular_price" class="col-md-4 col-lg-3 col-form-label">Regular Price<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="regular_price" type="text" class="form-control" id="regular_price" value="{{ $arr->regular_price }}" required>
                      <b><small class="text-danger">{{ $errors->first('regular_price') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="selling_price" class="col-md-4 col-lg-3 col-form-label">Selling Price<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="selling_price" type="text" class="form-control" id="selling_price" value="{{ $arr->selling_price }}" required>
                      <b><small class="text-danger">{{ $errors->first('selling_price') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="stock_amount" class="col-md-4 col-lg-3 col-form-label">Stock Amount<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="stock_amount" type="text" class="form-control" id="stock_amount" value="{{ $arr->stock_amount }}" required>
                      <b><small class="text-danger">{{ $errors->first('stock_amount') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="short_description" class="col-md-4 col-lg-3 col-form-label">Short Description<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">                      
                      <textarea type="text" value="{{ old('short_description') }}" name="short_description" rows="6" class="form-control" required>{{ $arr->short_description }}</textarea>
                      <b><small class="text-danger">{{ $errors->first('short_description') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="long_description" class="col-md-4 col-lg-3 col-form-label">Long Description<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">                      
                      <textarea type="text" value="{{ old('long_description') }}" name="long_description" class="form-control" id="editor" required>
                      {{ $arr->long_description }}
                      </textarea>
                      <b><small class="text-danger">{{ $errors->first('long_description') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="weight" class="col-md-4 col-lg-3 col-form-label">Weight<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="weight" type="text" class="form-control" id="weight" value="{{ $arr->weight }}" required>
                      <b><small class="text-danger">{{ $errors->first('weight') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="product_code" class="col-md-4 col-lg-3 col-form-label">Product Code<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="product_code" type="text" class="form-control" id="product_code" value="{{ $arr->product_code }}" required>
                      <b><small class="text-danger">{{ $errors->first('product_code') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="product_materials" class="col-md-4 col-lg-3 col-form-label">Product Materials<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="product_materials" type="text" class="form-control" id="product_materials" value="{{ $arr->product_materials }}" required>
                      <b><small class="text-danger">{{ $errors->first('product_materials') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Architecture<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">                    
                      <select id="architect_id" class="form-select" name="architect_id">
                          @foreach($architecture_arr as $architect)
                              <option value="{{ $architect->id }}" <?= ($architect->id == $arr->architect->id)? 'selected' : '' ?>>{{ $architect->name }}</option>
                          @endforeach
                      </select>
                      <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Category<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                    <select id="category_id" class="form-select" name="category_id">                          
                          @foreach($categories_arr as $category)
                          <option value="{{ $category->id }}" <?= ($category->id == $arr->category->id)? 'selected' : '' ?>>{{ $category->name }}</option>
                          @endforeach
                      </select>
                      <b><small class="text-danger">{{ $errors->first('name') }}</small></b>
                    </div>
                  </div>
                  

                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Status<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">

                      <select id="inputState" class="form-select" name="status">
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script>

    // $('body').on('click', ".upload__img-close", function(e) {
    //   $(this).closest('.upload__img-box').remove();
    // });

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

        // $('body').on('click', ".upload__img-close", function(e) {
        //     var file = $(this).parent().data("file");
        //     for (var i = 0; i < imgArray.length; i++) {
        //         if (imgArray[i].name === file) {
        //             imgArray.splice(i, 1);
        //             break;
        //         }
        //     }
        //     $(this).parent().parent().remove();
        // });
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


    CKEDITOR.replace('editor', {
      skin: 'moono',
      enterMode: CKEDITOR.ENTER_BR,
      shiftEnterMode:CKEDITOR.ENTER_P,
      toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
                  { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                  { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
                  { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                  { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                  { name: 'links', items: [ 'Link', 'Unlink' ] },
                  { name: 'insert', items: [ 'Image'] },
                  { name: 'spell', items: [ 'jQuerySpellChecker' ] },
                  { name: 'table', items: [ 'Table' ] }
                  ],
      });

</script>
@endsection