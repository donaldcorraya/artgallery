<?php 

if($total != 0){
    foreach($data as $item){
    $calculated = ($item->selling_price - $item->regular_price)/$item->regular_price * 100;
    $percentage = number_format($calculated,2);

?>
<a href="{{ route('shop.details', ['slug' => $item->slug])}}" class="search_href">
    <div class="row" style="display: flex;align-items: center;">
        <div class="col-lg-4">
            <img class="img-fluid" src="{{ asset($item->image) }}">
        </div>
        <div class="col-lg-8">
            <h6>{{ $item->name }}</h6>
            <div class="row">
                <div class="col-lg-12">
                    <b>${{ $item->selling_price}}</b>
                    @if($percentage < 0)
                    <span style="text-decoration: line-through; font-weight: 500;">${{ $item->regular_price }}</span>
                    <span class="text-white" style="background: #fa8231; padding: 2px 5px;">{{ $percentage }}%</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
</a>
<?php }}else{ ?>
    <div style="display: flex; justify-content: center; align-items: center; height: 50px; ">Sorry, No data found</div>
<?php } ?>