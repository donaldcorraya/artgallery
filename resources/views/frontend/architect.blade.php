<header class="border-bottom mb-4 pb-3">
    <div class="form-inline">
        <span>{{ $total_products }} {{ __('messages.Itemsfound') }} </span>
        <select class="mr-2 form-control mt-2" id="product_ordering">
            <option value="1" <?= ($order_type == 1)? 'selected' : '' ?>>{{ __('messages.Latestitems') }}</option>
            <option value="4" <?= ($order_type == 4)? 'selected' : '' ?>>{{ __('messages.Cheapest') }}</option>
        </select>
    </div>
</header>

<div class="row">
    <?php foreach ($arr as $product) {  ?>
        <div class="col-md-4">
            <figure class="card card-product-grid">
                <div class="card p-0">
                    <div class="card-header">
                        <a href="{{ route('shop.details', ['slug' => $product->slug])}}"><img src="{{ asset($product->image) }}" alt="img"></a>
                    </div>
                    <div class="card-body">
                        <div class="rating  col-md-12 col-xl-12">
                            <p>{{ $product->selling_price }}$</p>
                            @php
                            $averageRating = getRatings($product->id);
                            @endphp
                            <div class="rat col-md- col-xl-">
                                <div class="average-rating">
                                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$averageRating) <i class="fas fa-star"></i>
                                        <!-- Full star -->
                                        @else
                                        <i class="far fa-star"></i> <!-- Empty star -->
                                        @endif
                                        @endfor
                                        <span>({{ $averageRating }})</span>
                                </div>
                            </div>
                            <p>{{ $product->name }}</p>
                            <p>{{ __('messages.Dimension') }} : {{ $product->size }}</p>
                        </div>
                    </div>
                    <div class="woocommerce_cart">
                        <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})">
                            <div class="woo_cart">
                                <i class="fa-solid fa-cart-plus"></i>
                            </div>
                        </a>
                        <a href="{{route('wishlist.store', $product->id)}}" class="addToWish">
                            <div class="woo_cart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        </a>
                        <div class="woo_cart">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div class="woo_cart">
                            <a href="{{ route('shop.details', ['slug' => $product->slug])}}"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </figure>
        </div>

    <?php } ?>

</div>

@if($total_products > 0)
<nav>
    <ul class="pagination">
        <li class="page-item {{ (($page-1) < 1)? 'disabled' : '' }}" aria-disabled="true" aria-label="">
            <a id='pre' data-index="{{ $page-1 }}" class="page-link" href="javascript:void(0)" rel="next" aria-label="">Previous</a>
        </li>

        @for ($x = 1; $x <= $total_pages; $x++) <li class="page-item page_num <?= ($x == $page) ? 'active' : '' ?>" data-index="{{ $x }}" aria-current="page"><span class="page-link fw-bold">{{ $x }}</span></li>
            @endfor

            <li class="page-item {{ ($total_pages == $page)? 'disabled' : '' }}">
                <a id='next' data-index="{{ $page+1 }}" class="page-link" href="javascript:void(0)" rel="next" aria-label="">Next</a>
            </li>
    </ul>
</nav>
@endif


<script>
    $(document).ready(function() {

        var type = "{{ $type }}";
        const architecture_id = [];
        if (type == 1) {

            $('.architecture').each(function() {

                $('.cat_ul li').removeClass('active');

                if (this.checked) {
                    architecture_id.push($(this).val());
                }

            });

        }

        if (type == 2) {

            var val = $('.cat_ul').find('li.active a').attr('data-index');
            architecture_id.push(val);

        }

        if (type == 3) {

            architecture_id.push('%');

        }

        if (type == 4) {

            architecture_id.push('4');
            
            

        }
        


        if (architecture_id != '') {

            window.history.pushState(null, null, 'shop');

            

            if(architecture_id.includes('4')){
                
                var min = "{{ $min }}";
                var max = "{{ $max }}";

                
                
                $("#next").on('click', function() {
                    var page = $("#next").attr('data-index');
                    ajax_range(min, max, type, page);
                });


                $("#pre").on('click', function() {
                    var page = $("#pre").attr('data-index');
                    ajax_range(min, max, type, page);
                });

                $(".page_num").on('click', function() {
                    var page = $(this).attr('data-index');
                    ajax_range(min, max, type, page);
                });

                
                
            }else{

                $("#next").on('click', function() {
                    var page = $("#next").attr('data-index');
                    ajax_function(page, type, JSON.stringify(architecture_id));
                });


                $("#pre").on('click', function() {
                    var page = $("#pre").attr('data-index');
                    ajax_function(page, type, JSON.stringify(architecture_id));
                });

                $(".page_num").on('click', function() {
                    var page = $(this).attr('data-index');
                    ajax_function(page, type, JSON.stringify(architecture_id));
                });

            }

        }else{
            
            var order_type = this.value;

            $.ajax({
                type: 'GET',
                url: "{{ route('front.architect_id_ajax') }}",
                dataType: 'html',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                    'page': page,
                    'type': type,
                    'order_type' : order_type

                },
                success: function(data) {
                    if (data) {
                        $('#products').empty();
                        $('#products').html(data);
                    }
                },
            });

        }



    });
    

    function ajax_range(min, max, type, page){
        $.ajax({
            type: 'GET',
            url: "{{ route('front.architect_id_ajax') }}",
            dataType: 'html',
            data: {
                "_token": "{{ csrf_token() }}",
                'min': min,
                'max': max,
                'type' : type,
                'page' :  page

            },
            success: function(data) {
                if (data) {
                    $('#products').empty();
                    $('#products').html(data);
                }
            },
        });
    }

    function ajax_function(page, type, id) {

        var order_type = $("#product_ordering").val();
        $.ajax({
            type: 'GET',
            url: "{{ route('front.architect_id_ajax') }}",
            dataType: 'html',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id,
                'page': page,
                'type': type,
                'order_type' : order_type

            },
            success: function(data) {
                if (data) {
                    $('#products').empty();
                    $('#products').html(data);
                }
            },
        });

    }
</script>

<script>

$('#product_ordering').on('change', function(){
    $('.architecture').prop('checked', false);
    var order_type = this.value;

    $('.pagination').remove();
    $('.cat_ul li').removeClass('active');

    $.ajax({
        type: 'GET',
        url: "{{ route('front.architect_id_ajax') }}",
        dataType: 'html',
        data : {
            "_token": "{{ csrf_token() }}",
            'type' : 3,
            'order_type' : order_type
        },
        success: function (data) {
            if(data){
                $('#products').empty();
                $('#products').html(data);
            }
        },
    });
});

</script>